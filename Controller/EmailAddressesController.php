<?php

/**
 * Provides controll logic for email addresses
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
 */
App::uses('UsersAppController', 'Users.Controller');

/**
 * Provides controll logic for email addresses
 * @author Jason D Snider <jason@jasonsnider.com>
 * @package	Users
 */
class EmailAddressesController extends UsersAppController {

    /**
     * Holds the name of the controller
     *
     * @var string
     */
    public $name = 'EmailAddresses';

    /**
     * Called before action
     */
    public function beforeFilter() {

        parent::beforeFilter();
        $this->Auth->deny();
        $this->Authorize->allow('create');
    }

    /**
     * The models used by the controller
     *
     * @var array
     */
    public $uses = array(
        'Users.EmailAddress'
    );

    /**
     * Provides a UI for creating an email address against any model
     * @return void
     */
    public function create() {

        $model = 'Person';
        $model_id = $this->Session->read('Auth.User.id');
 
        if (!empty($this->request->data)) {
            if ($this->EmailAddress->save($this->data)) {

                $this->Session->setFlash(__('Your email address has been saved!'), 'success');

                $controller = Inflector::pluralize(Inflector::underscore($model));
                $this->redirect("/{$controller}/edit/{$model_id}");
            } else {
                $this->Session->setFlash(__('Your email address could not be saved!'), 'error');
            }
        } else {
            $this->request->data['EmailAddress'] = compact('model', 'model_id');
        }
    }

    /**
     * Provides a UI for creating an email address against any model
     * @param string $model
     * @param string $model_id
     */
    public function admin_create($model, $model_id) {
        if (!empty($this->data)) {
            if ($this->EmailAddress->save($this->data)) {
                $this->Session->setFlash(__('Your email address has been saved!'), 'success');
                $this->redirect($this->request->data['EmailAddress']['referer']);
            } else {
                $this->Session->setFlash(__('Your email address could not be saved!'), 'error');
            }
        } else {
			$referer = $this->referer();
            $this->request->data['EmailAddress'] = compact('model', 'model_id', 'referer');
        }
    }

    /**
     * A method for deleting a user_group
     * @param string $id
     */
    public function admin_delete($id) {

        if (!empty($id)) {
            if ($this->EmailAddress->purgeUserGroup($id)) {
                $this->Session->setFlash(__("Email address {$id} has been deleted!"), 'success');
            } else {
                $this->Session->setFlash(__("Email address {$id} could not be deleted!"), 'error');
            }
        }

        $this->redirect('/admin/users');
    }

}