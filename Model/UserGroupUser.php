<?php

/**
 * Provides a model for mananging user settings
 *
 * JSC (http://jasonsnider.com/jsc)
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

/**
 * Provides a model for mananging user settings
 * @author Jason D Snider <jason@jasonsnider.com>
 * @package	Users
 */
class UserGroupUser extends UsersAppModel {

    /**
     * Holds the model name
     * @var string
     */
    public $name = 'UserGroupUser';

    /**
     * Holds the name of the database table used by the model
     * @var string 
     */
    public $useTable = 'user_group_users';

    /**
     * Specifies the behaviors invoked by the model
     * @var array 
     */
    public $actsAs = array(
        'Jsc.Loggable',
        'Users.Scrubable' => array(
            'Filters' => array(
                'trim' => '*',
                'noHtml' => '*'
            )
        )
    );

    /**
     * Defines the belongsTo relationships for the model
     * @var array
     */
    public $belongsTo = array(
        'UserGroup' => array(
            'className' => 'Users.UserGroup',
            'foreignKey' => 'user_group_id',
            'dependent' => true
        ),
        'User' => array(
            'className' => 'Users.User',
            'foreignKey' => 'user_id',
            'dependent' => true
        )
    );

}