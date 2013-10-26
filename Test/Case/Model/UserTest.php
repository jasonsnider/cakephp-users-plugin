<?php

/**
 * Provides unit tests for the user model
 * 
 * Parbake (http://jasonsnider.com/parbake)
 * Copyright 2012, Jason D Snider. (http://jasonsnider.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *c
 * @copyright Copyright 2012, Jason D Snider. (http://jasonsnider.com)
 * @link http://jasonsnider.com
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @author Jason D Snider <jason@jasonsnider.com>
 * @package test/User
 */
App::uses('User', 'Users.Model');
App::uses('Random', 'Utilities.Lib');

/**
 * Provides unit tests for user model
 * 
 * @author Jason D Snider <jason@jasonsnider.com>
 * @package test/User
 */
class UserTest extends CakeTestCase {

    /**
     * Calls the fixtures needed by this test
     * @var array
     */
    public $fixtures = array(
        'plugin.users.email_address',
        'plugin.users.user_group_user',
        'plugin.users.user',
        'plugin.users.user_privilege',
        'plugin.users.user_setting'
    );

    /**
     * Method executed before each test
     */
    public function setUp() {
        parent::setUp();
        $this->User = ClassRegistry::init('Users.User');
        $this->UserSetting = ClassRegistry::init('Users.UserSetting');
    }

    /**
     * Method executed after each test
     */
    public function tearDown() {
        parent::tearDown();
        unset($this->User);
        unset($this->UserSetting);
    }

    /**
     * 
     */
    public function testPasswordAutoSaltAndHashCallback() {

        //Mock the user submitted data
        $data = array(
            'User' => array(
                'username' => 'testusername',
                'password' => 'password',
                'verify_password' => 'password'
            )
        );

        $this->User->create();
        
        if ($this->User->save($data)) {
            $result = $this->User->find(
                    'first', array(
                'conditions' => array(
                    'User.id' => $this->User->id
                ),
                'contain' => array()
                    )
            );
        }

        //returning 128 character string should mean hashing has occured
        $this->assertEquals(128, strlen($result['User']['hash']));
        $this->assertEquals(128, strlen($result['User']['salt']));

        $match = false;
        if ($result['User']['hash'] == $result['User']['salt']) {
            $match = true;
        }

        //A hashed value should never match itself
        $this->assertFalse($match);
    }

    /**
     * If root and employee settings are set for the first user but not the second, then first user detection is working
     */
    public function testCanDetectFirstUser(){
        
        //Clean out the users table
        $this->User->query('Truncate TABLE users');
        
        //Create a basic user array
        $data=array(
            'User'=>array(
                'username'=>'bob',
                'password'=>'password',
                'verify_password'=>'password'
            ),
            'EmailAddress'=>array(
                'email'=>'bob@example.com'
            )
        );
        
        $this->User->createUser($data);

        $user = $this->User->find(
            'first', 
            array(
                'conditions'=>array(
                    'User.id'=>$this->User->id
                ),
                'contain'=>array()
            )
        );
        
        //The first user created MUST have root and employee flags set by default
        $this->assertEqual(1, $user['User']['root']);
        $this->assertEqual(1, $user['User']['employee']);
        
        $data2=array(
            'User'=>array(
                'username'=>'bob2',
                'password'=>'password',
                'verify_password'=>'password'
            ),
            'EmailAddress'=>array(
                'email'=>'bob2@example.com'
            )
        );
        
        $this->User->createUser($data2);

        $user2 = $this->User->find(
            'first', 
            array(
                'conditions'=>array(
                    'User.id'=>$this->User->id
                ),
                'contain'=>array()
            )
        );
        
        //Any user created after the first CANNOT have root and employee flags set by default
        $this->assertEqual(0, $user2['User']['root']);
        $this->assertEqual(0, $user2['User']['employee']);
        
    }
    
    /**
     * 
     */
    public function testPasswordAutoSaltAndHashCallbackDoesNotFireWithOutAPassword() {
        $result1 = array();
        $result2 = array();

        //Empty passwords MUST NOT trigger hashing
        $this->User->create();

        $data1 = array(
            'User' => array(
                'username' => Random::random(15, 'l'),
                'password' => '',
                'verify_password' => ''
            )
        );


        if ($this->User->save($data1, array('validate' => false))) { //Since notEmpty is a validation rule
            $result1 = $this->User->find(
                    'first', array(
                'conditions' => array(
                    'User.id' => $this->User->id
                ),
                'contain' => array(),
                    )
            );
        }

        //Not setting a password MUST NOT trigger hashing
        $this->User->create();

        $data2 = array(
            'User' => array(
                'username' => Random::random(15, 'l')
            )
        );

        if ($this->User->save($data2)) {
            $result2 = $this->User->find(
                    'first', array(
                'conditions' => array(
                    'User.id' => $this->User->id
                ),
                'contain' => array()
                    )
            );
        }

        //debug($result2);

        $this->assertEmpty($result1['User']['hash']);
        $this->assertEmpty($result1['User']['salt']);

        $this->assertEmpty($result2['User']['hash']);
        $this->assertEmpty($result2['User']['salt']);
    }

    /**
     * Tests purge users
     */
    public function testPurgeUser() {

        $id = '509cfb03-7798-4c12-9ffb-05b37f000007';

        $this->User->purgeUser($id);

        //FindBy* methods are OK here since they should never find anything
        //Make sure the record was deleted
        $user = $this->User->findById($id);
        //Make sure the associated data was deleted
        $userSettings = $this->UserSetting->findByUserId($id);

        $this->assertEmpty($user);
        $this->assertEmpty($userSettings);
    }

    /**
     * Tests purge users
     */
    public function testPurgeUserWillNotDeleteAProtectedUser() {

        $id = '50a0edcf-d144-4470-ba4e-05437f000007';

        $toDelete = $this->User->purgeUser($id);

        $this->assertFalse($toDelete);

        //Make sure the record was not deleted
        $result = $this->User->find(
                'first', array(
            'conditions' => array(
                'User.id' => $id
            ),
            'contain' => array(
                'UserSetting'
            )
                )
        );
        
        $this->assertEquals('jason', $result['User']['username']);
        $this->assertEquals($id, $result['UserSetting']['user_id']);
    }

    /**
     * Tests setEmployeeFlag
     */
    public function testSetEmployeeFlag() {

        $id = '50a0ee0c-1e44-4869-b1e9-0f247f000007'; //This  record IS NOT an employee

        if ($this->User->setEmployeeFlag($id)) {
            $result = $this->User->find(
                    'first', array(
                'conditions' => array(
                    'User.id' => $id
                ),
                'contain' => array(
                    'UserSetting'
                )
                    )
            );
        }

        $this->assertEquals('sally', $result['User']['username']);
        $this->assertEquals(1, $result['User']['employee']);
    }

    /**
     * Tests setEmployeeFlag
     */
    public function testSetEmployeeFlagDoesNotCreateANewRecordWhenGivenAnInvalidId() {

        $id = 'xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx';

        $this->User->setEmployeeFlag($id);

        $result = $this->User->find(
                'first', array(
            'conditions' => array(
                'User.id' => $id
            ),
            'contain' => array(
                'UserSetting'
            )
                )
        );

        $this->assertEmpty($result);
    }

    /**
     * Tests unsetEmployeeFlag
     */
    public function testUnsetEmployeeFlag() {

        $id = '50a0edcf-d144-4470-ba4e-05437f000007'; //This  record IS an employee

        if ($this->User->unsetEmployeeFlag($id)) {
            $result = $this->User->find(
                    'first', array(
                'conditions' => array(
                    'User.id' => $id
                ),
                'contain' => array(
                    'UserSetting'
                )
                    )
            );
        }

        $this->assertEquals('jason', $result['User']['username']);
        $this->assertEquals(0, $result['User']['employee']);
    }

    /**
     * Tests unsetEmployeeFlag
     */
    public function testUnsetEmployeeFlagDoesNotCreateANewRecordWhenGivenAnInvalidId() {

        $id = 'xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx';

        $this->User->unsetEmployeeFlag($id);

        $result = $this->User->find(
                'first', array(
            'conditions' => array(
                'User.id' => $id
            ),
            'contain' => array(
                'UserSetting'
            )
                )
        );
        
        $this->assertEmpty($result);
    }

    /**
     * Tests fetch user salt
     */
    public function testFetchUserSalt() {

        $results = $this->User->fetchUserSalt('jason');
        $this->assertEquals($results, 'a5ca1c6afeac34b60b85aeb2e7e783ae8569d3eeb43bea71ab97f8567f7ba59db1f4e728a120473e75069e7f1f2cdbec689d5077311d3543892bcf93c8cc2ba0');
    }

    /**
     * Tests fetchVerifiedUser
     */
    public function testUsersMeetingTheCriteriaOfVerifiedUserWillBeReturned() {

        $results = $this->User->verifiedUser('50a0edcf-d144-4470-ba4e-05437f000007');
        

        $this->assertArrayHasKey('id', $results['User']);
        $this->assertEquals('50a0edcf-d144-4470-ba4e-05437f000007', $results['UserSetting']['user_id']);
        $this->assertEquals('50a0edcf-d144-4470-ba4e-05437f000007', $results['UserGroupUser'][0]['user_id']);
        
        $this->assertEquals($results['User']['username'], 'jason');
    }
    
    public function testShapeUserDataProperlyFormatsUserDataInToASessionCompatibleArray() {

        $theUser = $this->User->verifiedUser('50a0edcf-d144-4470-ba4e-05437f000007');
        $results = $this->User->shapeUserDataForSession($theUser);
        
        $this->assertArrayHasKey('id', $results['User']);
        $this->assertArrayHasKey('id', $results['User']['UserSetting']);
        $this->assertContains('50a1c275-8c38-477d-8682-0f247f000007', $results['User']['UserGroupUser']);
        $this->assertEquals($results['User']['username'], 'jason');
    }
    
    public function testProcessLoginSucceedsWithGoodData() {

        $data = array();
        $data['User']['username'] = 'jason';
        $data['User']['password'] = 'password';
        $attempt = $this->User->processLoginAttempt($data);
        $this->assertArrayHasKey('id', $attempt['User']);
    }
    
    public function testProcessLoginAttemptFailsIfThePasswordIsBad() {

        $data = array();
        $data['User']['username'] = 'jason';
        $data['User']['password'] = 'not-my-password';
        
        $attempt = $this->User->processLoginAttempt($data);
        $this->assertArrayHasKey('password', $this->User->validationErrors);
        $this->assertEmpty($attempt);
    }
    
    public function testProcessLoginAttemptFailsIfTheUserDoesNotExist() {

        $data = array();
        $data['User']['username'] = 'im-not-therefore-i-aint';
        $data['User']['password'] = 'password';
        
        $attempt = $this->User->processLoginAttempt($data);
        $this->assertArrayHasKey('username', $this->User->validationErrors);
        $this->assertEmpty($attempt);
    }
    
    public function testProcessLoginAttemptFailsIfTheSaltIsBad() {

        $data = array();
        $data['User']['username'] = 'bad-salt';
        $data['User']['password'] = 'password1';
        
        $attempt = $this->User->processLoginAttempt($data);
        //$this->assertArrayHasKey('password', $this->User->validationErrors);
        $this->assertEmpty($attempt);
    }
}