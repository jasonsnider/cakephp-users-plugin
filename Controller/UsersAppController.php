<?php

/**
 * Settings required for the users controller
 *
 * Parbake (http://jasonsnider.com)
 * Copyright 2013, Jason D Snider. (http://jasonsnider.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2013, Jason D Snider. (http://jasonsnider.com)
 * @link http://jasonsnider.com
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @package	Users
 */
App::uses('AppController', 'Controller');

/**
 * Application wide controller settings, properties and functionality
 *
 * @author Jason D Snider <jason@jasonsnider.com>
 * @package app
 */
class UsersAppController extends AppController {
    
    /**
     * Called before action
     */
    public function beforeFilter() {
        parent::beforeFilter();
    }

    /**
     * Called after the action
     */
    public function beforeRender() {
        parent::beforeRender();
    }

}