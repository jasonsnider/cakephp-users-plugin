<?php

/**
 * Provides unit tests for the user model
 * 
 * Parbake (http://jasonsnider.com/parbake)
 * Copyright 2012, Jason D Snider. (http://jasonsnider.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2012, Jason D Snider. (http://jasonsnider.com)
 * @link http://jasonsnider.com
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @author Jason D Snider <jason@jasonsnider.com>
 * @package test/User
 */
App::uses('UserPrivilege', 'Users.Model');

/**
 * Provides unit tests for user model
 * 
 * @author Jason D Snider <jason@jasonsnider.com>
 * @package test/User
 */
class UserPrivilegeTest extends CakeTestCase {

    /**
     * Calls the fixtures needed by this test
     * @var array
     */
    public $fixtures = array(
        'plugin.users.user_privilege'
    );

    /**
     * Method executed before each test
     */
    public function setUp() {
        parent::setUp();
        $this->UserPrivilege = ClassRegistry::init('UserPrivilege');
    }

    /**
     * Method executed after each test
     */
    public function tearDown() {
        parent::tearDown();
        unset($this->UserPrivilege);
    }

    public function testPlaceholder() {
        
    }

}