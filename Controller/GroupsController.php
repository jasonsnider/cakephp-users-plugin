<?php

/**
 * Provides controll logic for groups
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
 * Provides controll logic for managing groups
 * @author Jason D Snider <jason.snider@42viral.org>
 * @package app/Groups
 */
class GroupsController extends UsersAppController {

    /**
     * Holds the name of the controller
     *
     * @var string
     */
    public $name = 'Groups';

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
        'Users.Group'
    );

    /**
     * Displays an index of all groups
     */
    public function admin_index() {

        $this->paginate = array(
            'conditions' => array(),
            'limit' => 30
        );

        $groups = $this->paginate('Group');
        $this->set(compact('groups'));
    }

    /**
     * A method for creating a new group in the system
     */
    public function admin_create() {

        if (!empty($this->request->data)) {

            if ($this->Group->createGroup($this->request->data)) {
                $this->Session->setFlash(__('The record has been created!'), 'success');
            } else {
                $this->Session->setFlash(__('Please correct the erros below!'), 'error');
            }
        }
    }

    /**
     * A method for creating a new group in the system
     * @param string $id
     */
    public function admin_view($id) {

        $group = $this->Group->find(
                'first', array(
            'conditions' => array(
                'Group.id' => $id
            ),
            'contain' => array()
                )
        );

        $this->set(compact('group', 'id'));
    }

    /**
     * Allows an admin to update a groups record
     * @param string $id
     */
    public function admin_edit($id) {

        if (!empty($this->request->data)) {

            foreach ($this->request->data['GroupPrivilege'] as $key => $values) {
                if ($values['allowed'] == 2) {
                    if (isset($values['id'])) {
                        //If a previously set priv is set to undefined, delete it's record fron the system.
                        $this->Group->GroupPrivilege->delete($values['id']);
                    }
                    unset($this->request->data['GroupPrivilege'][$key]);
                }
            }

            if ($this->Group->saveAll($this->request->data)) {
                $this->Session->setFlash(__('The record has been update!'), 'success');
            } else {
                $this->Session->setFlash(__('The record could not be updated!'), 'error');
            }
        }

        $this->request->data = $this->Group->find(
                'first', array(
            'conditions' => array(
                'Group.id' => $id
            ),
            'contain' => array(
                'GroupPrivilege'
            )
                )
        );

        if (isset($this->request->data['GroupPrivilege'])) {
            $groupPrivileges = $this->request->data['GroupPrivilege'];
        } else {
            $groupPrivileges = array();
        }

        $controllers = $this->Authorize->privileges($groupPrivileges);

        $this->set(compact('id', 'controllers'));
    }

    /**
     * A method for deleting a group
     * @param string $id
     */
    public function admin_delete($id) {

        if (!empty($id)) {
            if ($this->Group->purgeGroup($id)) {
                $this->Session->setFlash(__("Group {$id} has been deleted!"), 'success');
            } else {
                $this->Session->setFlash(__("Group {$id} could not be deleted!"), 'error');
            }
        }

        $this->redirect('/admin/groups');
    }

}