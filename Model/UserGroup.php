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
class UserGroup extends AppModel {

    /**
     * Holds the model name
     * @var string
     */
    public $name = 'UserGroup';

    /**
     * Holds the name of the database table used by the model
     * @var string 
     */
    public $useTable = 'user_groups';

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
        'UserGroupPrivilege' => array(
            'className' => 'UserGroupPrivilege',
            'foreignKey' => 'user_group_id',
            'dependent' => true
        ),
        'UserGroupUser' => array(
            'className' => 'UserGroupUser',
            'foreignKey' => 'user_group_id',
            'dependent' => true
        )
    );

    /**
     * Creates a new privilege user_group
     * @param array $data
     * @return boolean
     */
    public function createUserGroup($data) {

        //Auto gen the slugs
        $data['UserGroup']['alias'] = Inflector::slug($data['UserGroup']['name'], '_');

        $newUserGroup = $this->save($data);
        return empty($newUserGroup) ? false : true;
    }

    /**
     * Removes a privilege user_group and all child data from the system
     * @param string $userId
     */
    public function purgeUserGroup($userId) {
        return $this->delete($userId);
    }

    /**
     * Merges UserGroup into UserGroupUser for single user, the result is all possible user_groups with a corresponding UserGroupUser
     * element for each user_group of which the target user is a member.
     * @param array $user_groupUsers
     * @return array
     */
    public function fetchUserGroupsWithUser($user_groupUsers) {

        $theUserGroups = array();

        $user_groups = $this->find(
                'all', array(
            'contain' => array()
                )
        );

        foreach ($user_groups as $user_group) {
            $theUserGroups[$user_group['UserGroup']['alias']] = $user_group;
        }

        foreach ($user_groupUsers as $user_groupUser) {
            $theUserGroups[$user_groupUser['UserGroup']['alias']] = $user_groupUser;
        }

        return $theUserGroups;
    }

}