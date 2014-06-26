<?php
/**
 * A class for determinig if a user is authorized for a particular actions.
 *
 * JSC (http://jasonsnider.com/jsc)
 * Copyright 2012, Jason D Snider. (http://jasonsnider.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2012, Jason D Snider. (http://jasonsnider.com)
 * @link http://jasonsnider.com
 * @license MIT License (http://www.opensource.org/licenses/mit-licensephp)
 */
App::uses('JscAppController', 'Jsc.Controller');

/**
 * A class for determinig if a user is authorized for a particular actions.
 * 
 * Some parts adapted from
 * @link https://github.com/cakephp/cakephp/blob/master/lib/Cake/Controller/Component/AuthComponent.php
 * 
 * @author Jaso D Snider <jason@jasonsnider.com>
 * @package	Users
 */
class AuthorizeComponent extends Component {

    /**
     * Holds a list of actions that `MUST NOT` be checked for authorizaition. 
     * 
     * Auth Compnonent Usage
     * 
     * - Items added to this list will still require authentication; assuming they are not in 
     * $this->Auth->allowedActions
     * - Any item that is has been added to $this->Auth->allowedActions will automatically be added to this list.
     *  
     * @var type 
     */
    public $allowedActions = array();

    /**
     * Calls the components to be used by this component
     * @var type
     */
    public $components = array(
        'Auth',
        'Users.Ctrl',
        'Session'
    );

    /**
     * Request object
     *
     * @var CakeRequest
     */
    public $request;

    /**
     * Response object
     *
     * @var CakeResponse
     */
    public $response;

    /**
     * Controller object
     *
     * @var object
     */
    public $controller;

    /**
     * User model object
     *
     * @var object
     */
    public $Privilege;

    /**
     * Initializes AuthorizeComponent for use in the controller
     *
     * @param Controller $controller A reference to the instantiating controller object
     */
    public function initialize(Controller $controller) {
        if (Configure::read('debug') > 0) {
            Debugger::checkSecurityKeys();
        }
    }

    /**
     * Main execution method.  Handles redirecting of invalid users, and processing
     * of login form data.
     *
     * @param Controller $controller A reference to the instantiating controller object
     * @todo Decide the best course of action to take after a Authorization Fails
     * @return mixed redirects a failed authorization attempt
     */
    public function startup(Controller $controller) {

        $this->request = $controller->request;
        $this->response = $controller->response;

        $this->controller = $controller;
        $this->UserPrivilege = ClassRegistry::init('UserPrivilege');
        $this->UserGroupPrivilege = ClassRegistry::init('UserGroupPrivilege');

        if ($this->isAuthorized() === false) {

            //throw new NotFoundException();
            //throw new MethodNotAllowedException();

            $this->Session->setFlash(__('You have not been authorized for that action!'));
            return $this->controller->redirect($this->Auth->redirect());
            die;
        }
    }

    /**
     * Builds the list of allowedActions
     * @param string $action
     */
    public function allow($action = null) {
        $args = func_get_args();
        if (empty($args) || $action === null) {
            //If an allow() is empty only allow those actions defined in $this->Auth->allowedActions
            $this->allowedActions = $this->Auth->allowedActions;
        } else {
            if (isset($args[0]) && is_array($args[0])) {
                $args = $args[0];
            }
            $this->allowedActions = array_merge($this->Auth->allowedActions, $args);
        }
    }

    /**
     * Returns true if the logged in user has ROOT level privleges
     * @return boolean
     */
    private function __isRoot() {

        $root = $this->Session->read('Auth.User.root');

        if (!empty($root)) {
            return true;
        }

        return false;
    }

    /**
     * returns true if the current action is in the list of allowed actions 
     * @return boolean
     */
    private function __skipCheck() {

        //If the user has ROOT access no further authoriztion checks will be executed.
        if ($this->__isRoot()) {
            return true;
        }

        $action = $this->request->params['action'];

        //An * was passed, no authorization is requested.
        if (in_array('*', $this->allowedActions)) {
            return true;
        }

        //If the action does not exist, skip the authorization check
        if (!in_array($action, $this->controller->methods)) {
            return true;
        }

        //If the action is in the list of allowed actions, skip the authorization check
        if (in_array($action, $this->allowedActions)) {
            return true;
        }

        return false;
    }

    /**
     * Determines if a user is authorized to access a particaular controller/action
     */
    public function isAuthorized() {

        if ($this->__skipCheck()) {
            return true;
        }

        //Gather the parameters needed to check the priv
        $controller = Inflector::camelize($this->request->params['controller']) . 'Controller';
        $action = $this->request->params['action'];
        $userId = $this->Session->read('Auth.User.id');
        $userUserGroupIds = $this->Session->read('Auth.User.UserGroupUser');

        //debug(compact('userId', 'action', 'controller', 'userUserGroupIds', 'authorizedIds'));       
        //Look up the priv
        $userPrivilege = $this->UserPrivilege->find(
                'first', array(
            'conditions' => array(
                'UserPrivilege.controller' => $controller,
                'UserPrivilege.action' => $action,
                'UserPrivilege.user_id' => $userId
            ),
            'contain' => array(),
            'fields' => array(
                'UserPrivilege.allowed'
            )
                )
        );

        //Find any user_group privs
        $userUserGroupPrivilege = $this->UserGroupPrivilege->find(
                'first', array(
            'conditions' => array(
                'UserGroupPrivilege.controller' => $controller,
                'UserGroupPrivilege.action' => $action,
                'UserGroupPrivilege.user_group_id' => $userUserGroupIds
            ),
            'contain' => array(),
            'fields' => array(
                'UserGroupPrivilege.allowed'
            )
                )
        );

        //initialize the allowed variable
        $allowed = false;

        //Set allowed to true if any one user_group the user belongs to has the desired privilege.
        if (!empty($userUserGroupPrivilege)) {
            if ($userUserGroupPrivilege['UserGroupPrivilege']['allowed'] === true) {
                $allowed = true;
            }
        }

        //If the user specifically has a privilege set, it will override the user_group setting
        if (!empty($userPrivilege)) {

            //The user specifically has a privilege denied
            if ($userPrivilege['UserPrivilege']['allowed'] === false) {
                return false;
            }

            //The user specifically has a privilege allowed
            if ($userPrivilege['UserPrivilege']['allowed'] === true) {
                return true;
            }
        }

        return $allowed;
    }

    /**
     * Returns an array of all controller actions merege with a users privileges for those actions
     * @param array $privileges The privileges of a single user_group or user
     * @return array 
     */
    public function privileges($privileges) {

        $parsedPrivilege = array();
        $potentialPrivilege = array();

        foreach ($this->Ctrl->get() as $key => $value) {
            foreach ($value as $k => $v) {
                $potentialPrivilege[$key][$v] = array();
            }
        }

        foreach ($privileges as $privilege) {
            $parsedPrivilege[Inflector::classify($privilege['controller'])][$privilege['action']] = array(
                'id' => $privilege['id'],
                'allowed' => $privilege['allowed']
            );
        }

        return array_merge_recursive($potentialPrivilege, $parsedPrivilege);
    }

    /**
     * Returns true if you are the asset you are trying to access.
     * @param string $userId
     * @param string $message Overrides the default message
     * @return mixed
     */
    public function me($userId, $message = "That doen't belong to you!") {
        $sessionUserId = $this->Session->read('Auth.User.id');
        if ($sessionUserId != $userId) {
            $this->Session->setFlash(__($message));
            return $this->controller->redirect($this->Auth->redirect());
        } else {
            return true;
        }
    }

}