<?php
/**
 * Provides a model for mananging users
 *
 * Copyright 2012, Jason D Snider. (http://jasonsnider.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 * 
 * @copyright Copyright 2012, Jason D Snider
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License
 * @author Jason D Snider <jason@jasonsnider.com>
 * @package app/User
 */
App::uses('UsersAppModel', 'Users.Model');
App::uses('Random', 'Utilities.Lib');
App::uses('StringHash', 'Utilities.Lib');
App::uses('Scrubbable', 'Utilities.Model/Behavior');
App::uses('CakeEmail', 'Network/Email');
App::uses('String', 'Utility');

/**
 * Provides a model for mananging users
 * @author Jason D Snider <jason@jasonsnider.com>
 * @package	Users
 */
class User extends UsersAppModel {

    /**
     * The static name this model
     * @var string
     */
    public $name = 'User';

    /**
     * The table to be used by this model
     * @var string
     */
    public $useTable = 'users';

    /**
     * Specifies the behaviors invoked by the model
     * @var array 
     */
    public $actsAs = array(
        'Utilities.Loggable',
        'Utilities.Scrubable' => array(
            'Filters' => array(
                'trim' => '*',
                'noHtml' => '*',
                'lower' => 'email'
            )
        )
    );

    /**
     * Defines has one relationships this model
     * @var array
     */
    public $hasOne = array(
        'UserSetting' => array(
            'className' => 'Users.UserSetting',
            'foreignKey' => 'user_id',
            'dependent' => true
        )
    );

    /**
     * Defines has many relationships this model
     * @var array
     */
    public $hasMany = array(
        'EmailAddress' => array(
            'className' => 'Users.EmailAddress',
            'foreignKey' => 'model_id',
            'conditions' => array(
                'model' => 'User'
            ),
            'dependent' => true
        ),
        'UserGroupUser' => array(
            'className' => 'Users.UserGroupUser',
            'foreignKey' => 'user_id',
            'dependent' => true
        ),
        'UserPrivilege' => array(
            'className' => 'Users.UserPrivilege',
            'foreignKey' => 'user_id',
            'dependent' => true
        )
    );

    /**
     * Defines the validation to be used by this model
     * @var array
     */
    public $validate = array(
        /* Since we sometimes need this to be null notEmpty is a bad idea!
          'password_confirmation' => array(
          'notEmpty' => array(
          'rule' => 'notEmpty',
          'message' => "Please enter your password confirmation.",
          'last' => true
          ),
          ),
         */
        'username' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => "Please enter username.",
                'last' => true
            ),
            'isUnique' => array(
                'rule' => 'isUnique',
                'message' => "This username is already in use.",
                'last' => true
            )
        ),
        'password' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => "Please enter a password.",
                'last' => true
            ),
            'verifyPassword' => array(
                'rule' => 'verifyPassword',
                'message' => 'Your passwords do not match.',
                'last' => true
            ),
        ),
        'verify_password' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => "Please verfiy your password.",
                'last' => true
            ),
            'verifyPassword' => array(
                'rule' => 'verifyPassword',
                'message' => 'Your passwords do not match.',
                'last' => true
            )
        ),
    );

    /**
     * Checks precondtions and applies pre save logic
     * 
     * - When a password is passed, create a new salt value for that user and hash it with the password to create a hash
     * passwords will never be saved as either plain text or in a password column.
     * 
     * @return boolean
     */
    public function beforeSave() {

        //Deal with passwords
        if (isset($this->data[$this->alias]['password'])) {
            $this->setPassword();
        }

        return true;
    }

    /**
     * Checks precondtions and applies pre deletion logic
     * 
     * - DO NOT allow protected records to be deleted
     * 
     * @param boolean $cascade
     * @return boolean
     */
    public function beforeDelete($cascade = true) {

        //DO NOT allow empty records to be deleted
        $record = $this->find(
            'first', 
            array(
                'conditions' => array(
                    "{$this->alias}.id" => $this->id,
                    "{$this->alias}.protected" => 0,
                ),
                'contain' => array()
            )
        );

        return empty($record) ? false : true;
    }

    /**
     * Validation Rule - Returns true if the password and verify_password are a match.
     * 
     * @return boolean
     */
    public function verifyPassword() {

        //Return false if any of the expected fields are empty

        if(empty($this->data[$this->alias]['password'])){
            return false;
        }
        
        if(empty($this->data[$this->alias]['verify_password'])){
            return false;
        }
        
        //Compare the fields, if they match, return true.
        if ($this->data[$this->alias]['password'] == $this->data[$this->alias]['verify_password']) {
            return true;
        }
        
        //No match, fail the validation check.
        return false;
    }

    /**
     * Returns true if no users exist in the database
     * @return boolean
     */
    protected function _isFirstUser() {

        $isEmpty = $this->find('first', array('contain' => array()));

        if (empty($isEmpty)) {
            return true;
        }

        return false;
    }
    
    /**
     * Returns 1 if the no other users have been created
     * @return integer
     */
    protected function _setRootForFirstUser(){
        if($this->_isFirstUser()){
            return (INT)1;
        }
        return (INT)0;
    }
    
    /**
     * Returns 1 if the no other users have been created
     * @return integer
     */
    protected function _setEmployeeForFirstUser(){
        if($this->_isFirstUser()){
            return (INT)1;
        }
        return (INT)0;
    }

    /**
     * Creates a new user and returns true upon success
     * @param array $data
     * @return boolean
     */
    public function createUser($data) {
        
        $data['User']['root'] = $this->_setRootForFirstUser();
        $data['User']['employee'] = $this->_setEmployeeForFirstUser();

        $data = array(
            'User' => $data['User'],
            //'UserPrivilege' => $this->defaultPrivilege(),
            'UserSetting' => array(
                'visibility' => 'public'
            ),
            'EmailAddress' => $data['EmailAddress']
        );
        
        $newUser = $this->saveAll($data);
        return empty($newUser) ? false : true;
    }

    /**
     * Removes a user and all child data from the system.
     * Returns true upon success.
     * @param string $userId
     * @return bollean
     */
    public function purgeUser($userId) {
        return $this->delete($userId);
    }

    /**
     * Salts and hashes a users password while adding it tot he data array.
     */
    public function setPassword() {
        if (!empty($this->data[$this->alias]['password'])) {
            //Anytime a password is submitted, create a new salt value for that user
            $userSalt = Random::makeSalt();
            $userStringHash = StringHash::password($this->data[$this->alias]['password'], $userSalt);
            $this->data[$this->alias]['hash'] = $userStringHash;
            $this->data[$this->alias]['salt'] = $userSalt;
        }
    }

    /**
     * Adds an employee flag to a user record
     * 
     * @param string $userId the id of the effected user
     * @return boolean
     */
    public function setEmployeeFlag($userId) {
        return $this->updateAll(array("{$this->alias}.employee" => 1), array("{$this->alias}.id" => $userId));
    }

    /**
     * Removes the employee flag from a user record
     * 
     * @param string $userId the id of the effected user
     * @return boolean
     */
    public function unsetEmployeeFlag($userId) {
        return $this->updateAll(array("{$this->alias}.employee" => 0), array("{$this->alias}.id" => $userId));
    }

    /**
     * Returns a given users salt value
     * @param string $username
     * @return boolean|string
     */
    public function fetchUserSalt($username) {

        $user = $this->find(
            'first', 
            array(
                'conditions' => array(
                    "{$this->alias}.username" => $username
                ),
                'fields' => array(
                    "{$this->alias}.salt"
                ),
                'contain' => array()
            )
        );

        return empty($user) ? false : $user[$this->alias]['salt'];
    }
    
    /**
     * Verifies the authenticity of user suplied credentials
     * @param string $username
     * @param string $password
     * @param string $salt
     * @return boolean|string
     * @depricated
     */
    public function verifyUser($username, $password, $salt) {

        $hash = StringHash::password($password, $salt);

        $user = $this->find(
            'first', 
            array(
                'conditions' => array(
                    "{$this->alias}.username" => $username,
                    "{$this->alias}.hash" => $hash
                ),
                'fields' => array(
                    "{$this->alias}.id"
                ),
                'contain' => array()
            )
        );

        return empty($user) ? false : $user[$this->alias]['id'];
    }
    
    /**
     * Returns an empty array if the requested user is not verifiable; meaning they have and active record that is not 
     * suspended and the like. Otherwise we retrun an array.
     * 
     * @param string $token
     * @return boolean|array
     */
    public function verifiedUser($token) {
        
        $user = $this->find(
            'first', 
            array(
                'conditions' => array(
                    'or'=>array(
                        "{$this->alias}.id" => $token,
                        "{$this->alias}.username" => $token,
                    )
                ),
                'fields' => array(),
                'contain' => array(
                    'UserGroupUser',
                    'UserSetting'
                )
            )
        );
                        
        return $user;
    }
    
    /**
     * Reshaps an array of user data into a session friendly 
     * For sessions we want to follow Auth.User.[all associated user data].
     * @param array $user
     * @return array
     */
    public function shapeUserDataForSession($user){
        
        $shapedUser = array();
        $shapedUser['User'] = $user['User'];
        
        //Add the users settings
        $shapedUser['User']['UserSetting'] = $user['UserSetting'];
        
        //Add the id of each user_group to which the user is a member
        $shapedUser['User']['UserGroupUser'] = Set::extract('/UserGroupUser/./user_group_id', $user);
        
        return $shapedUser;
    }

    /**
     * Processes a login attempt, returns an empty array if nthe attempt failed, returns a populated session ready
     * array of user data on success.
     * @param array $data
     * @return array
     */
    public function processLoginAttempt($data){
            
        //// 1. Fetch the salt value for the given username
        $salt = $this->fetchUserSalt($data['User']['username']);

        if($salt){

            //// 2. If faethUserSalt did not return false, verify the given user creadintials
            $isVerified = $this->verifyUser(
                $data['User']['username'], 
                $data['User']['password'], 
                $salt
            );

            if($isVerified){
                //// 3. Now that the password has been verified, grab the user data
                $verifiedUser = $this->verifiedUser($data['User']['username']);

                if (!empty($verifiedUser)) {
                    //// 4. Push the user data into a session friendly format
                    return $this->shapeUserDataForSession($verifiedUser);
                }
            }else{
                $this->validationErrors['password'] = 'Invalid password.';
            }
            
        }else{
            $this->validationErrors['username'] = 'User not found.';
        }

        //Something went wrong, return an empty array
        return array();
    }

}