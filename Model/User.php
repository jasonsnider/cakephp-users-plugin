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
        'GroupUser' => array(
            'className' => 'Users.GroupUser',
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
                'first', array(
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
        $valid = false;
        if ($this->data[$this->alias]['password'] == $this->data[$this->alias]['verify_password']) {
            $valid = true;
        }
        return $valid;
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
        $data['User']['employee'] = $this->_setEmployeetForFirstUser();

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
                'first', array(
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
     * Verifies the authenticity of usersuplied credentials
     * @param string $username
     * @param string $password
     * @param string $salt
     * @return boolean|string
     */
    public function verifyUser($username, $password, $salt) {

        $hash = StringHash::password($password, $salt);

        $user = $this->find(
                'first', array(
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
     * Users a verfiedUserId to retrive a users data for login. The returned data array will be used as session data.
     * @param string $verifiedUserId
     * @return boolean|array
     */
    public function fetchVerifiedUser($verifiedUserId) {

        $user = $this->find(
                'first', array(
            'conditions' => array(
                "{$this->alias}.id" => $verifiedUserId
            ),
            'fields' => array(),
            'contain' => array(
                'GroupUser',
                'UserSetting'
            )
                )
        );

        $verifiedUser = array();
        $verifiedUser['User'] = $user['User'];
        //Add the users settings
        $verifiedUser['User']['UserSetting'] = $user['UserSetting'];
        //Add the id of each group to which the user is a member
        $verifiedUser['User']['GroupUser'] = Set::extract('/GroupUser/./group_id', $user);
        return empty($user) ? false : $verifiedUser;
    }

    /**
     * Creates the data needed for requesting a new password.
     * 
     *  - Creates a pasword expiry
     *  - Creates a pasword confirmation
     * 
     * Returns true if the password reset request data was saved successfully.
     * 
     * @param string $username The username for which we want to request a change of password.
     * @return boolean
     */
    public function createPasswordReset($username) {
        //Create a functin for verifiable users?
        $user = $this->find(
                'first', array(
            'conditions' => array(
                'User.username' => $username
            ),
            'contain' => array(
                'EmailAddress'
            )
                )
        );

        if (!empty($user)) {

            $data = array();
            $data['User']['id'] = $user['User']['id'];
            $data['User']['password_confirmation_expiry'] = date('Y-m-d H:i:s', strtotime('+24 hours'));
            $data['User']['password_confirmation'] = String::uuid();

            if ($this->save($data)) {

                $serverName = env('SERVER_NAME');
                $entityName = 'Picilicious';

                $email = new CakeEmail('passwordReset');
                $email->to($user['EmailAddress'][0]['email'])
                    ->viewVars(
                        array(
                            'entityName' => $entityName,
                            'serverName' => $serverName,
                            'username' => $username,
                            'confirmation' => $data['User']['password_confirmation']
                        )
                    )
                    ->send();

                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * Returns true if a password_confirmation is (still) valid.
     * 
     * @param string $username
     * @param string $password_confirmation
     * @return boolean|string
     */
    public function verfiyPasswordReset($username, $password_confirmation) {

        $confirm = $this->find(
                'first', array(
            'conditions' => array(
                "{$this->alias}.password_confirmation_expiry >=" => date('Y-m-d H:i:s'),
                "{$this->alias}.password_confirmation" => $password_confirmation,
                "{$this->alias}.username" => $username
            ),
            'fields' => array(
                "{$this->alias}.id"
            ),
            'contain' => array()
                )
        );

        if (!empty($confirm)) {
            return $confirm[$this->alias]['id'];
        } else {
            return false;
        }
    }

    /**
     * Returns true if a users password was successfully reset
     * 
     * @param string $confirmedUserId The id of the confirmed user
     * @param array $data The user sumbitted data
     * @return boolean Returns true if the passward was succefully reset
     */
    public function resetPassword($confirmedUserId, $data) {

        //Verify the user id
        if (!$confirmedUserId) {
            return false;
        }

        //Verify the user id
        if (empty($data[$this->alias]['id'])) {
            return false;
        }

        //Verify the user id
        if ($data[$this->alias]['id'] != $confirmedUserId) {
            return false;
        }

        //Reset the confirmation fields
        $data[$this->alias]['password_confirmation_expiry'] = '0000-00-00 00:00:00';
        $data[$this->alias]['password_confirmation'] = null;

        //Change the password
        if ($this->save($data)) {
            return true;
        } else {
            return false;
        }
    }

}