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
App::uses('UserSetting', 'Users.Model');
App::uses('Utility', 'Lib');

/**
 * Provides unit tests for user model
 * 
 * @author Jason D Snider <jason@jasonsnider.com>
 * @package test/User
 */
class UserSettingTest extends CakeTestCase {

    /**
     * Calls the fixtures needed by this test
     * @var array
     */
    public $fixtures = array(
        'plugin.users.user_setting'
    );

    /**
     * Method executed before each test
     */
    public function setUp() {
        parent::setUp();
        $this->UserSetting = ClassRegistry::init('UserSetting');
    }

    /**
     * Method executed after each test
     */
    public function tearDown() {
        parent::tearDown();
        unset($this->UserSetting);
    }

    /**
     * Confirms meta can be retrived by passing an alias.
     */
    public function testPlaceholder() {
        
    }

}