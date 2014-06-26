<?php

/**
 * Settings required for the users controller
 *
 * JSC (http://jasonsnider.com)
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
App::uses('JscAppController', 'Jsc.Controller');

/**
 * Application wide controller settings, properties and functionality
 *
 * @author Jason D Snider <jason@jasonsnider.com>
 * @package app
 */
class UsersAppController extends JscAppController {
    
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