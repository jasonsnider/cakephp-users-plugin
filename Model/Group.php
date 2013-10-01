<?php

/**
 * Provides a model for mananging user settings
 *
 * Parbake (http://jasonsnider.com/parbake)
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
class Group extends AppModel {

    /**
     * Holds the model name
     * @var string
     */
    public $name = 'Group';

    /**
     * Holds the name of the database table used by the model
     * @var string 
     */
    public $useTable = 'groups';

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
    public $belongsTo = array();

    /**
     * Defines has many relationships this model
     * @var array
     */
    public $hasMany = array(
        'GroupPrivilege' => array(
            'className' => 'GroupPrivilege',
            'foreignKey' => 'group_id',
            'dependent' => true
        ),
        'GroupUser' => array(
            'className' => 'GroupUser',
            'foreignKey' => 'group_id',
            'dependent' => true
        )
    );

    /**
     * Creates a new privilege group
     * @param array $data
     * @return boolean
     */
    public function createGroup($data) {

        //Auto gen the slugs
        $data['Group']['alias'] = Inflector::slug($data['Group']['name'], '_');

        $newGroup = $this->save($data);
        return empty($newGroup) ? false : true;
    }

    /**
     * Removes a privilege group and all child data from the system
     * @param string $userId
     */
    public function purgeGroup($userId) {
        return $this->delete($userId);
    }

    /**
     * Merges Group into GroupUser for single user, the result is all possible groups with a corresponding GroupUser
     * element for each group of which the target user is a member.
     * @param array $groupUsers
     * @return array
     */
    public function fetchGroupsWithUser($groupUsers) {

        $theGroups = array();

        $groups = $this->find(
                'all', array(
            'contain' => array()
                )
        );

        foreach ($groups as $group) {
            $theGroups[$group['Group']['alias']] = $group;
        }

        foreach ($groupUsers as $groupUser) {
            $theGroups[$groupUser['Group']['alias']] = $groupUser;
        }

        return $theGroups;
    }

}