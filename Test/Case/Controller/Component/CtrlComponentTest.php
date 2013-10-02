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
App::uses('UsersController', 'Users.Controller');
App::uses('ComponentCollection', 'Controller');
App::uses('CtrlComponent', 'Users.Controller/Component');

/**
 * Provides unit tests for the users controller
 * 
 * @author Jason D Snider <jason@jasonsnider.com>
 * @package test/User
 */
class CtrlComponentTest extends ControllerTestCase {

    public $PagematronComponent = null;
    public $Controller = null;
    public $fixtures = array(
        'plugin.users.user_privilege',
        'plugin.users.user'
    );

    /**
     * Method executed before each test
     */
    public function setUp() {
        parent::setUp();
        // Setup our component and fake test controller
        $Collection = new ComponentCollection();
        $this->CtrlComponent = new CtrlComponent($Collection);
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
        $this->CtrlComponent->startup($this->Controller);
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
    public function testPrivilegesByCheckingAdainstTheDefaultFirstUserSettings() {
        $controllers = $this->CtrlComponent->get();
        debug($controllers);

        $this->assertArrayHasKey('UsersController', $controllers);
        $this->assertArrayHasKey('UserGroupsController', $controllers);
        $this->assertArrayHasKey('PagesController', $controllers);

        $this->assertContains('index', $controllers['UsersController']);
        $this->assertContains('create', $controllers['UsersController']);
        $this->assertContains('view', $controllers['UsersController']);
        $this->assertContains('edit', $controllers['UsersController']);
        $this->assertContains('admin_index', $controllers['UsersController']);
        $this->assertContains('admin_view', $controllers['UsersController']);
        $this->assertContains('admin_edit', $controllers['UsersController']);
        $this->assertContains('admin_delete', $controllers['UsersController']);
        $this->assertContains('login', $controllers['UsersController']);
        $this->assertContains('logout', $controllers['UsersController']);

        $this->assertContains('admin_index', $controllers['UserGroupsController']);
        $this->assertContains('admin_create', $controllers['UserGroupsController']);
        $this->assertContains('admin_view', $controllers['UserGroupsController']);
        $this->assertContains('admin_edit', $controllers['UserGroupsController']);
        $this->assertContains('admin_delete', $controllers['UserGroupsController']);

        $this->assertContains('display', $controllers['PagesController']);
    }

}