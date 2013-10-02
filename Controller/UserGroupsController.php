<?php

/**
 * Provides controll logic for user_groups
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
 * @package	Users
 */
App::uses('UsersAppController', 'Users.Controller');

/**
 * Provides controll logic for managing user_groups
 * @author Jason D Snider <jason.snider@42viral.org>
 * @package app/UserGroups
 */
class UserGroupsController extends UsersAppController {

    /**
     * Holds the name of the controller
     *
     * @var string
     */
    public $name = 'UserGroups';

    /**
     * Called before action
     */
    public function beforeFilter() {

        parent::beforeFilter();
        $this->Auth->deny();
        $this->Authorize->allow();
    }

    /**
     * The models used by the controller
     *
     * @var array
     */
    public $uses = array(
        'Users.UserGroup'
    );

    /**
     * Displays an index of all user_groups
     */
    public function admin_index() {

        $this->paginate = array(
            'conditions' => array(),
            'limit' => 30
        );

        $user_groups = $this->paginate('UserGroup');
        $this->set(compact('user_groups'));
    }

    /**
     * A method for creating a new user_group in the system
     */
    public function admin_create() {

        if (!empty($this->request->data)) {

            if ($this->UserGroup->createUserGroup($this->request->data)) {
                $this->Session->setFlash(__('The record has been created!'), 'success');
            } else {
                $this->Session->setFlash(__('Please correct the erros below!'), 'error');
            }
        }
    }

    /**
     * A method for creating a new user_group in the system
     * @param string $id
     */
    public function admin_view($id) {

        $user_group = $this->UserGroup->find(
                'first', array(
            'conditions' => array(
                'UserGroup.id' => $id
            ),
            'contain' => array()
                )
        );

        $this->set(compact('user_group', 'id'));
    }

    /**
     * Allows an admin to update a user_groups record
     * @param string $id
     */
    public function admin_edit($id) {

        if (!empty($this->request->data)) {

            foreach ($this->request->data['UserGroupPrivilege'] as $key => $values) {
                if ($values['allowed'] == 2) {
                    if (isset($values['id'])) {
                        //If a previously set priv is set to undefined, delete it's record fron the system.
                        $this->UserGroup->UserGroupPrivilege->delete($values['id']);
                    }
                    unset($this->request->data['UserGroupPrivilege'][$key]);
                }
            }

            if ($this->UserGroup->saveAll($this->request->data)) {
                $this->Session->setFlash(__('The record has been update!'), 'success');
            } else {
                $this->Session->setFlash(__('The record could not be updated!'), 'error');
            }
        }

        $this->request->data = $this->UserGroup->find(
                'first', array(
            'conditions' => array(
                'UserGroup.id' => $id
            ),
            'contain' => array(
                'UserGroupPrivilege'
            )
                )
        );

        if (isset($this->request->data['UserGroupPrivilege'])) {
            $user_groupPrivileges = $this->request->data['UserGroupPrivilege'];
        } else {
            $user_groupPrivileges = array();
        }

        $controllers = $this->Authorize->privileges($user_groupPrivileges);

        $this->set(compact('id', 'controllers'));
    }

    /**
     * A method for deleting a user_group
     * @param string $id
     */
    public function admin_delete($id) {

        if (!empty($id)) {
            if ($this->UserGroup->purgeUserGroup($id)) {
                $this->Session->setFlash(__("UserGroup {$id} has been deleted!"), 'success');
            } else {
                $this->Session->setFlash(__("UserGroup {$id} could not be deleted!"), 'error');
            }
        }

        $this->redirect('/admin/user_groups');
    }

}