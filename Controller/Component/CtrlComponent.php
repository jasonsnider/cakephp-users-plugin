<?php

/**
 * A component for retreving all controllers and methods
 * 
 * Component rewritten, original from : http://cakebaker.42dh.com/2006/07/21/how-to-list-all-controllers/
 * @link http://cakebaker.42dh.com/2006/07/21/how-to-list-all-controllers/
 * Rewritten for CakePHP 2.0 by: http://www.cleverweb.nl/cakephp/list-all-controllers-in-cakephp-2/
 * @link http://www.cleverweb.nl/cakephp/list-all-controllers-in-cakephp-2/
 * Logic for including plugins by Lyubomir R Dimov
 * @author Lyubomir R Dimov <lrdimov@yahoo.com>
 * Rewritten by Jason Snider
 * @link http:://jasonsnider.com
 */

/**
 * A component for retreving all controllers and methods
 * @package	Users
 */
class CtrlComponent extends Component {

    public function startup(Controller $controller) {
        $this->Controller = $controller;
    }

    /**
     * Return an array of user Controllers and their methods.
     * The function will exclude ApplicationController methods
     * @return array
     */
    public function getControllers() {

        $aCtrlClasses = App::objects('controller');

        foreach ($aCtrlClasses as $controller) {
            if ($controller != 'AppController') {
                // Load the controller
                App::import('Controller', str_replace('Controller', '', $controller));

                // Load its methods / actions
                $aMethods = get_class_methods($controller);
                if (!empty($aMethods)) {
                    foreach ($aMethods as $idx => $method) {
                        if ($method{0} == '_') {
                            unset($aMethods[$idx]);
                        }
                    }

                    // Load the ApplicationController (if there is one)
                    App::import('Controller', 'AppController');
                    $parentActions = get_class_methods('AppController');

                    $controllers[$controller] = array_diff($aMethods, $parentActions);
                }
            }
        }
        return $controllers;
    }

    /**
     * Returns a list of controllers and actions belonging to plugins
     *
     * @access public
     * @return array
     */
    public function getPlugins() {
        $pluginDirs = App::objects('plugin', null, false);
        $plugins = array();

        foreach ($pluginDirs as $pluginDir) {

            $pluginClasses = App::objects('controller', APP . 'Plugin' . DS . $pluginDir . DS . 'Controller', false);

            App::import('Controller', $pluginDir . '.' . $pluginDir . 'App');
            $parentActions = get_class_methods($pluginDir . 'AppController');

            foreach ($pluginClasses as $plugin) {

                if (strpos($plugin, 'App') === false) {

                    $plugin = str_ireplace('Controller', '', $plugin);
                    App::import('Controller', $pluginDir . '.' . $plugin);
                    $actions = get_class_methods($plugin . 'Controller');

                    foreach ($actions as $k => $v) {
                        if ($v{0} == '_') {
                            unset($actions[$k]);
                        }
                    }

                    $plugins[$pluginDir][$plugin] = array_diff($actions, $parentActions);
                }
            }
        }

        return $plugins;
    }

    /**
     * 
     * @return returns a list of all controllers within all plugins
     */
    public function getPluginControllers() {

        $plugins = $this->getPlugins();

        $pluginControllers = array();

        foreach ($plugins as $plugin) {
            foreach ($plugin as $controller => $actions) {
                $pluginControllers[$controller . 'Controller'] = $plugin[$controller];
            }
        }

        return $pluginControllers;
    }

    /**
     * Retrives a list of all controllers and action(including plugins)
     *
     * @access public
     * @return array
     */
    public function get() {
        return array_merge($this->getControllers(), $this->getPluginControllers());
    }

    /**
     * Returns an array of all Controllers and that controllers views. A view is not be confussed with an action.
     * @return array
     */
    function fetchViewsForControllers() {

        $paths = array();
        foreach ($this->get() as $controller => $methods) {

            $theController = str_replace('Controller', '', $controller);
            $base = ROOT . DS . APP_DIR . DS;
            $themed = $base . 'View' . DS . 'Themed' . DS; // . '' . DS . $theController;
            $standard = $base . 'View' . DS . $theController;
            $plugged = $base . 'Plugin' . DS;

            //Check the "default/standard/non-themed" paths
            if (is_dir($standard)) {
                foreach (scandir($standard) as $file):
                    if (!in_array($file, array('.', '..'))) {
                        $paths[$theController][$file] = $file;
                    }
                endforeach;
            }

            //Check the "themed" paths
            foreach (Configure::read('Theme.themeset') as $theme) {
                $thisTheme = $themed . $theme . DS . $theController;
                if (is_dir($thisTheme)) {
                    foreach (scandir($thisTheme) as $file):
                        if (!in_array($file, array('.', '..'))) {
                            $paths[$theController][$file] = $file;
                        }
                    endforeach;
                }
            }
            //debug(App::paths());

            foreach (scandir($plugged) as $plugin) {
                $thisPlugin = $plugged . $plugin . DS . 'View' . DS . $theController;
                if (is_dir($thisPlugin)) {
                    foreach (scandir($thisPlugin) as $file):
                        if (!in_array($file, array('.', '..'))) {
                            $paths[$theController][$file] = $file;
                        }
                    endforeach;
                }
            }
        }
        return $paths;
    }

}