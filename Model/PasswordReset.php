<?php
/**
 * Provides a model for mananging password resets
 *
 * Copyright 2013, Jason D Snider. (http://jasonsnider.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 * 
 * @copyright Copyright 2012, Jason D Snider
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License
 * @author Jason D Snider <jason@jasonsnider.com>
 * @package Users
 */
App::uses('UsersAppModel', 'Users.Model');
App::uses('Random', 'Utilities.Lib');
App::uses('HasFormat', 'Utilities.Lib');
App::uses('StringHash', 'Utilities.Lib');
App::uses('Scrubbable', 'Utilities.Model/Behavior');
App::uses('CakeEmail', 'Network/Email');
App::uses('String', 'Utility');

/**
 * Provides a model for mananging users
 * @author Jason D Snider <jason@jasonsnider.com>
 * @package	Users
 */
class PasswordReset extends UsersAppModel {

    /**
     * The static name this model
     * @var string
     */
    public $name = 'PasswordRest';

    /**
     * The table to be used by this model
     * @var string
     */
    public $useTable = 'password_resets';

    /**
     * Defines has one relationships this model
     * @var array
     */
    public $hasMany = array(
        'User' => array(
            'className' => 'Users.User',
            'foreignKey' => 'user_id',
            'dependent' => true
        )
    );
    
    /**
     * Defines the validation to be used by this model
     * @var array
     */
    public $validate = array(
        'id' => array(
            'isUUID' => array(
                'rule' => array('isUUID', 'id'),
                'message' => 'The primary key must be a UUID.',
                'last' => true
            )
        ),
        'user_id' => array(
            'isUUID' => array(
                'rule' => array('isUUID', 'user_id'),
                'message' => 'The user id must be a UUID.',
                'last' => true
            )
        )
    );

    /**
     * Validation Rule - Returns true if the id isa UUID.
     * @param string $check
     * @param string $field
     * @return boolean
     */
    public function isUUID($check, $field) {
        $valid = false;
        if (HasFormat::uuid($this->data[$this->alias][$field])) {
            $valid = true;
        }
        return $valid;
    }

    /**
     * Creates the data needed for requesting a new password.
     * 
     * Returns true if the password reset request data was saved successfully.
     * 
     * @param string $id
     * @return boolean|string
     */
    public function createPasswordReset($userId) {        
        $confirmation =  Random::uuid();
        
        $data = array();
        $data['PasswordReset']['id'] = $confirmation;
        $data['PasswordReset']['user_id'] = $userId;
        
        if($this->save($data)){
            return $confirmation;
        }

        return false;
    }
    
    /**
     * Retruns the array that represents a given password reset.
     * 
     * @param string $id
     * @param string $userId
     * @return array
     */
    public function fetchPasswordReset($id, $userId) {

        $confirm = $this->find(
            'first', 
            array(
                'conditions' => array(
                    "{$this->alias}.id" => $id,
                    "{$this->alias}.user_id" => $userId
                ),
                'fields' => array(
                    "{$this->alias}.id",
                    "{$this->alias}.created",      
                ),
                'contain' => array()
            )
        );

        return $confirm;
        
    }

    
    /**
     * @param string $created
     * @param string $isUnix
     * @return boolean
     */
    public function isExpired($created, $isUnix = false){
        
        $createdAsTimeStamp = strtotime($created);
        $createdPlus24 = strtotime('+24 hours', $createdAsTimeStamp);
        $now = time();

        if($now <= $createdPlus24){
            return false;
        }
        
        return true;
    }
    
    /**
     * Returns true if a password reset has not yet expired
     * @param string $created
     * @param string $isUnix
     * @return boolean
     */
    public function notExpired($created, $isUnix = false){
        
        $createdAsTimeStamp = strtotime($created);
        $createdPlus24 = strtotime('+24 hours', $createdAsTimeStamp);
        $now = time();

        if($now >= $createdPlus24){
            return false;
        }
        
        return true;
    }
    
    /**
     * Returns true if a requested password reset is valid
     * @param string $passwordResetId
     * @param string $userId
     * @return boolean
     */
    public function isValid($passwordResetId, $userId){
        //Retrieve the newly created password
        $passwordReset = $this->fetchPasswordReset($passwordResetId, $userId);
        
        //If the reset array is empty, return false
        if(empty($passwordReset)){
            return false;
        }
        
        //Test the expiry of the new pssword
        $isExpired = $this->notExpired($passwordReset['PasswordReset']['created']);
        
        return $isExpired;
    }
    
    /**
     * Returns true if a users password was successfully reset
     * 
     * @param array $data The user sumbitted data
     * @return boolean Returns true if the passward was succefully reset
     */
    public function setPassword($data) {

        //We cannot reset a password, if we do not have the user id.
        if(!isset($data['id'])){
            CakeLog::write('password_reset', 'Missing user_id in ' . __METHOD__);
            return false;
        }

        //Change the password
        if ($this->User->save($data)) {
            return true;
        }

        return false;
    }
    
    /**
     * Provides a single method for perfoming a password reset.
     * @param array $data
     * @return boolean
     */
    public function reset($data){

        if(empty($data)){
            CakeLog::write('password_reset', 'Empty attribute $data passed to ' . __METHOD__);
            return false;
        }

        if(empty($data['password_confirmation'])){
            CakeLog::write('password_reset', 'Empty attribute $data[password_confirmation] passed to ' . __METHOD__);
            return false;
        }

        $passwordResetId = $data['password_confirmation'];
        
        if(!HasFormat::uuid($passwordResetId)){
            CakeLog::write('password_reset', '$passwordResetId is not a uuid ' . __METHOD__);
            return false;
        }
        
        //Verfiy the user by name and fetch that users data
        $user = $this->User->verifiedUser($data['username']);

        if(empty($user)){
            return false;
        }
        
        //Push the user id into the data array
        $data['id'] = $user['User']['id'];

        //Verify that the password reset confirmatin is valid 
        $isValid = $this->isValid($passwordResetId, $user['User']['id']);

        if(!$isValid){
            return false;
        }

        //Reset the pasword
        if($this->setPassword($data)){
            //$this->delete($passwordResetId); //[TODO] Not working?
            $this->query("DELETE FROM password_resets WHERE id = '{$passwordResetId}'");
            return true;
        }else{
            return false;
        }
        
    }
    
}