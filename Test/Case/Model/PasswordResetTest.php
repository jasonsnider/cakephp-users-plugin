<?php
/**
 * Provides unit tests for the user model
 * 
 * Parbake (http://jasonsnider.com/parbake)
 * Copyright 2013, Jason D Snider. (http://jasonsnider.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2013, Jason D Snider. (http://jasonsnider.com)
 * @link http://jasonsnider.com
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @author Jason D Snider <jason@jasonsnider.com>
 * @package test/User
 */
App::uses('PasswordReset', 'Users.Model');
App::uses('Random', 'Utilities.Lib');
App::uses('HasFormat', 'Utilities.Lib');

/**
 * Provides unit tests for user model
 * 
 * @author Jason D Snider <jason@jasonsnider.com>
 * @package test/User
 */
class PasswordResetTest extends CakeTestCase {

    /**
     * Calls the fixtures needed by this test
     * @var array
     */
    public $fixtures = array(
        'plugin.users.user',
        'plugin.users.password_reset',
        'plugin.users.user_setting',
        'plugin.users.user_group_user'
    );

    /**
     * Method executed before each test
     */
    public function setUp() {
        parent::setUp();
        $this->User = ClassRegistry::init('Users.User');
        $this->PasswordReset = ClassRegistry::init('Users.PasswordReset');
    }

    /**
     * Method executed after each test
     */
    public function tearDown() {
        parent::tearDown();
        unset($this->User);
        unset($this->PasswordReset);
    }

    public function testCreatesAPasswordResetAgainstAGivenUserId(){
        //A random user id
        $userId = '50a0edcf-d144-4470-ba4e-05437f000002';
        
        $this->PasswordReset->createPasswordReset($userId);
        
        $results = $this->PasswordReset->find(
            'first',
            array(
                'conditions'=>array(
                    'PasswordReset.user_id'=>$userId
                ),
                'contain'=>array()
            )
        );

        $this->assertTrue(HasFormat::uuid($results['PasswordReset']['id']));
        $this->assertArrayHasKey('id', $results['PasswordReset']);
    }

    public function testFetchResetPasswordReturnsAnArrayOnMatch(){
        
        $id = '52573a00-588c-4be2-9602-c4b3cd9b91e0';
        $userId = '50a0edcf-d144-4470-ba4e-05437f000007';
        
        $passwordReset = $this->PasswordReset->fetchPasswordReset($id, $userId);
        
        $this->assertEqual($id, $passwordReset['PasswordReset']['id']);
    }
    
    public function testFetchResetPasswordReturnsAnEmptyArrayWhenNoMatchIsFound(){
        
        $id = '00000000-0000-0000-0000-000000000000';
        $userId = '00000000-0000-0000-0000-000000000000';
        
        $passwordReset = $this->PasswordReset->fetchPasswordReset($id, $userId);
        
        $this->assertEmpty($passwordReset);
    }
    
    public function testPasswordResetIsExpiredAfter24Hours(){
        $id = '52573a00-588c-4be2-9602-c4b3cd9b91e0';
        $userId = '50a0edcf-d144-4470-ba4e-05437f000007';
        
        $passwordReset = $this->PasswordReset->fetchPasswordReset($id, $userId);
        $isExpired = $this->PasswordReset->isExpired($passwordReset['PasswordReset']['created']);
        
        $this->assertTrue($isExpired);
        
        $notExpired = $this->PasswordReset->notExpired($passwordReset['PasswordReset']['created']);
        $this->assertFalse($notExpired);
        
    }
    
    public function testNewlyCreatedPasswordResetsAreNotExpired(){
        //Create a new password reset
        $userId = '50a0edcf-d144-4470-ba4e-05437f000007';
        $this->PasswordReset->createPasswordReset($userId);
        
        //Retrieve the newly created password
        $passwordReset = $this->PasswordReset->fetchPasswordReset($this->PasswordReset->id, $userId);
        
        //Test the expiry of the new password
        $isExpired = $this->PasswordReset->isExpired($passwordReset['PasswordReset']['created']);
        $this->assertFalse($isExpired);

        $notExpired = $this->PasswordReset->notExpired($passwordReset['PasswordReset']['created']);
        $this->assertTrue($notExpired);
        
    }

    public function testNewlyCreatedPasswordResetsCanBeRetrivedAndValidated(){
        //Create a new password reset
        $userId = '50a0edcf-d144-4470-ba4e-05437f000007';
        $this->PasswordReset->createPasswordReset($userId);
        
        //Test the expiry of the new pssword
        $isValid = $this->PasswordReset->isValid($this->PasswordReset->id, $userId);

        $this->assertTrue($isValid);    
    }

    public function testCreatePasswordReturnsFalseOnFail(){
        //Create a new password reset
        $userId = 'not-a-uuid';
        $passwordReset = $this->PasswordReset->createPasswordReset($userId);
        $this->assertFalse($passwordReset);    
    }

    public function testCreatePasswordReturnsFalseWhenAThePassedUserIdIsNotAUuid(){
        //Create a new password reset
        $userId = 'not-a-uuid';
        $passwordReset = $this->PasswordReset->createPasswordReset($userId);
        $this->assertFalse($passwordReset);    
    }

    public function testExpiredPasswordResetsCanBeRetrivedAndValidated(){
        $id = '52573a00-588c-4be2-9602-c4b3cd9b91e0';
        $userId = '50a0edcf-d144-4470-ba4e-05437f000007';
        
        //Test the expiry of the new pssword
        $isValid = $this->PasswordReset->isValid($id, $userId);

        $this->assertFalse($isValid);
            
    }
    
    public function testRequestsForInvalidPasswordResetCannotBeRetrivedAndOrValidated(){
        $id = '52573a00-588c-4be2-9602-c4b3cd9b91e0';
        $userId = '50a0edcf-d144-4470-ba4e-05437f000007';
        
        //Test the expiry of the new pssword
        $isValid = $this->PasswordReset->isValid($id, $userId);

        $this->assertFalse($isValid);
            
    }

    public function testNewlyExpiredPasswordResetsCanBeRetrivedAndValidated2(){
        $id = '52573a00-588c-4be2-9602-c4b3cd9b91e0';
        $userId = '50a0edcf-d144-4470-ba4e-05437f000007';
        
        $invalidId = '00000000-0000-0000-0000-000000000000';
        $invalidUserId = '00000000-0000-0000-0000-000000000000';

        $withInvalidUser = $this->PasswordReset->isValid($id, $invalidUserId);
        $this->assertFalse($withInvalidUser);

        $withInvalidId = $this->PasswordReset->isValid($invalidId, $userId);
        $this->assertFalse($withInvalidId);
    }

    public function testSetPasswordChangesTheUsersHash(){

        $user = $this->User->verifiedUser('jason');

        $data = array();
        $data['id'] = $user['User']['id'];
        $data['password'] = 'new_password1';
        $data['verify_password'] = 'new_password1';
        
        $this->PasswordReset->setPassword($data);
        
        $updatedUser = $this->User->verifiedUser('jason');

        $this->assertNotEquals($user['User']['hash'], $updatedUser['User']['hash']);        
    }
    
    public function testSetPasswordReturnsFalseWithIncompleteData(){

        $user = $this->User->verifiedUser('jason');
        
        $data = array();
        $data['id'] = $user['User']['id'];
        $data['password'] = 'new_password77';
        $this->assertFalse($this->PasswordReset->setPassword($data));
        
        $data = array();
        $data['id'] = $user['User']['id'];
        $data['password'] = 'new_password77';
        $data['verify_password'] = '';
        $this->assertFalse($this->PasswordReset->setPassword($data));

        $data = array();
        $data['id'] = $user['User']['id'];
        $data['password'] = '';
        $data['verify_password'] = 'new_password77';
        $this->assertFalse($this->PasswordReset->setPassword($data));
        
        $data = array();
        $data['password'] = 'new_password77';
        $data['verify_password'] = 'new_password77';
        $this->assertFalse($this->PasswordReset->setPassword($data));

        $data = array();
        $data['id'] = $user['User']['id'];
        $data['password'] = '';
        $data['verify_password'] = '';
        $this->assertFalse($this->PasswordReset->setPassword($data));

        $data = array();
        $data['id'] = $user['User']['id'];
        $this->assertFalse($this->PasswordReset->setPassword($data));
        
        $data = array();
        $this->assertFalse($this->PasswordReset->setPassword($data));
    }
    
    public function testResetFailsWithAnEmptyDataArray(){
        $this->assertFalse($this->PasswordReset->reset(array()));
    }
    
    public function testResetFailsWithAnEmptyPasswordConfirmation(){
        
        $data = array();
        $this->assertFalse($this->PasswordReset->reset($data));
        
        $data['password_confirmation'] = '';
        $this->assertFalse($this->PasswordReset->reset($data));
        
    }

    public function testResetFailsAgainstANonUser(){
        
        $data = array();
        $data['username'] = 'im-not-a-user';
        $data['password'] = 'new_password77';
        $data['verify_password'] = 'new_password77';
        $data['password_confirmation'] = '52573a00-588c-4be2-9602-c4b3cd9b91e0';
        $this->assertFalse($this->PasswordReset->reset($data));
        
    }

    public function testResetFailsAgainstAnExpiredPasswordConfirmation(){
        
        $data = array();
        $data['username'] = 'jason';
        $data['password'] = 'new_password77';
        $data['verify_password'] = 'new_password77';
        //This id is known to be expired
        $data['password_confirmation'] = '52573a00-588c-4be2-9602-c4b3cd9b91e0';
        $this->assertFalse($this->PasswordReset->reset($data));
        
    }

    public function testResetFailsIfThePasswordResetIdIsNotAUuid(){
        
        $data = array();        
        $data['password_confirmation'] = 'not-a-uuid';
        $this->assertFalse($this->PasswordReset->reset($data));
        
    }
    
     
    public function testResetProcessWorksWhenAllConditionsAreValid(){
        
        //Create a new password reset
        $userId = '50a0edcf-d144-4470-ba4e-05437f000007';
        $this->PasswordReset->createPasswordReset($userId);
        
        $data = array();
        $data['username'] = 'jason';
        $data['password'] = 'new_password77';
        $data['verify_password'] = 'new_password77';
        $data['password_confirmation'] = $this->PasswordReset->id;

        $this->assertTrue($this->PasswordReset->reset($data));
    }
}