<?php

/**
 * Provides a model for mananging email addresses
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
 * @package app/Data
 */
App::uses('UsersAppModel', 'Users.Model');

/**
 * Provides a model for mananging email addresses
 * @author Jason D Snider <jason@jasonsnider.com>
 * @package	Users
 */
class EmailAddress extends AppModel {

    /**
     * Holds the model name
     * @var string
     */
    public $name = 'EmailAddress';

    /**
     * Holds the name of the database table used by the model
     * @var string 
     */
    public $useTable = 'email_addresses';

    /**
     * Specifies the behaviors invoked by the model
     * @var array 
     */
    public $actsAs = array(
        'Utilities.Loggable',
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
            'foreignKey' => 'model_id',
            'conditions' => array(
                'model' => 'User'
            ),
            'dependent' => true
        )
    );

    /**
     * Defines the validation to be used by this model
     * @var array
     */
    public $validate = array(
        'email' => array(
            'email' => array(
                'rule' => array('email', false),
                'message' => 'Please enter a valid email address.',
                'last' => true
            ),
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => "Please enter and email address.",
                'last' => true
            ),
            'isUnique' => array(
                'rule' => 'isUnique',
                'message' => "This email address is already in use.",
                'last' => true
            )
        )
    );

}