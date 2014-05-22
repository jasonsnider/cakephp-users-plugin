<?php
/**
 * Provides a model for mananging a users profile data
 *
 * JSC (http://jasonsnider.com/jsc)
 * Copyright 2013, Jason D Snider. (http://jasonsnider.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 * 
 * @copyright Copyright 2013, Jason D Snider
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License
 * @author Jason D Snider <jason@jasonsnider.com>
 */
App::uses('UsersAppModel', 'Users.Model');

/**
 * Provides a model for mananging a users profile data
 * @author Jason D Snider <jason@jasonsnider.com>
 * @package	Users
 */
class UserProfile extends UsersAppModel {

    /**
     * Holds the model name
     * @var string
     */
    public $name = 'UserProfile';

    /**
     * Holds the name of the database table used by the model
     * @var string 
     */
    public $useTable = 'user_profiles';

    /**
     * Specifies the behaviors invoked by the model
     * @var array 
     */
    public $actsAs = array(
        //'Loggable',
        'Utilities.Scrubable' => array(
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
        'User' => array(
            'className' => 'Users.User',
            'foreignKey' => 'user_id',
            'dependent' => true
        )
    );

}