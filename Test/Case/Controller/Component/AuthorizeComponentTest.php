<?php

/**
 * Provides unit tests for the users controller
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
App::uses('Controller', 'Controller');
App::uses('CakeRequest', 'Network');
App::uses('CakeResponse', 'Network');
App::uses('ComponentCollection', 'Controller');
App::uses('UsersController', 'Users.Controller');
App::uses('AuthorizeComponent', 'Users.Controller/Component');

/**
 * Provides unit tests for the users controller
 * 
 * @author Jason D Snider <jason@jasonsnider.com>
 * @package test/User
 */
class AuthorizeComponentTest extends ControllerTestCase {

    public $PagematronComponent = null;
    public $Controller = null;
    public $fixtures = array(
        'plugin.users.user_group',
        'plugin.users.user_group_privilege',
        'plugin.users.user_group_user',
        'plugin.users.user',
        'plugin.users.user_privilege'
    );

    /**
     * Method executed before each test
     */
    public function setUp() {
        parent::setUp();
        // Setup our component and fake test controller
        $Collection = new ComponentCollection();
        $this->AuthorizeComponent = new AuthorizeComponent($Collection);
        $CakeRequest = new CakeRequest();
        $CakeResponse = new CakeResponse();
        $this->Controller = new UsersController($CakeRequest, $CakeResponse);
        $this->Controller->request->params = array(
            'plugin' => null,
            'controller' => null,
            'action' => 'admin_login',
            'named' => array(),
            'pass' => array()
        );
        $this->AuthorizeComponent->startup($this->Controller);
    }

    /**
     * Method executed after each test
     */
    public function tearDown() {
        parent::tearDown();
    }

    /**
     * Spotchecks a few of the retruned privileges
     */
    public function testUserPrivileges() {}

    /**
     * Spotchecks a few of the retruned privileges
     */
    public function testUserGroupPrivileges() {}

}