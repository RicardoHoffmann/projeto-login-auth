<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\I18n\Time;
use Cake\Core\Plugin;
use Cake\Core\App;
use Cake\Filesystem\Folder;
use Cake\Utility\Inflector;
use Cake\Utility\Hash;
use Cake\Controller\Controller;
use Cake\Utility\Text;

class ActionsComponent extends Component
{
    /**
     * @return array
     */
    public function listPlugins()
    {
        $plugins = Plugin::loaded();

        foreach ($plugins as $key => $value) {
            $parsed_plugins[Text::slug($value, '-')] = $value;
        }

        return $parsed_plugins;
    }

    /**
     * @param null $plugin
     * @return array
     */
    public function listSlugedControllers($plugin=null)
    {
        $controllers = $this->listControllers($plugin);

        foreach ($controllers as $key => $value) {
            $parsed_value = str_replace('Controller.php', '', $value);
            if ($parsed_value != 'App') {
                $index = Text::slug($parsed_value, '-');
                $parsed_controllers[$index] = $parsed_value;
            }
        }

        return $parsed_controllers;
    }

    /**
     * Get a list of controllers in the app and plugins.
     *
     * Returns an array of path => import notation.
     *
     * @param string $plugin Name of plugin to get controllers for
     * @param string $prefix Name of prefix to get controllers for
     * @return array
     */
    private function listControllers($plugin = null, $prefix = null)
    {
        if (!$plugin) {
            $dir = new Folder(APP);
            $controllers = $dir->findRecursive('.*Controller\.php');
        } else {
            $path = App::path('Controller' . (empty($prefix) ? '' : DS . Inflector::camelize($prefix)), $plugin);
            $dir = new Folder($path[0]);
            $controllers = $dir->find('.*Controller\.php');
        }
        return $controllers;
    }

    public function listControllerActions($plugin=null, $controller=null)
    {
        $pluginPath = $this->_pluginAlias($plugin);

        return $this->_checkMethods($controller. 'Controller.php', $pluginPath, null);
    }

    /**
     * @return array
     */
    private function listPrefix()
    {
        $prefixes = array();

        $routes = Router::routes();
        foreach ($routes as $key => $route) {
            if (isset($route->defaults['prefix'])) {
                $prefix = Inflector::camelize($route->defaults['prefix']);
                if (!isset($route->defaults['plugin'])) {
                    $prefixes[] = $prefix;
                } else {
                    $prefixes[] = $route->defaults['plugin'] . '/' . $prefix;
                }
            }
        }

        return $prefixes;
    }

    /**
     * @param $controllers
     * @param null $plugin
     * @param null $prefix
     * @return array
     */
    protected function listControllersActions($controllers, $plugin = null, $prefix = null)
    {
        $pluginPath = $this->_pluginAlias($plugin);
        // look at each controller
        $actions = [];
        foreach ($controllers as $controller) {
            $tmp = explode('/', $controller);
            $controllerName = str_replace('Controller.php', '', array_pop($tmp));
            if ($controllerName == 'App') {
                continue;
            }

            debug($controller . '');
            debug($pluginPath);
            exit();

            $actions[$controllerName] = $this->_checkMethods($controller, $pluginPath, $prefix);
        }
        return $actions;
    }

    /**
     * Check and Add/delete controller Methods
     *
     * @param string $className The classname to check
     * @param string $controllerName The controller name
     * @param array $node The node to check.
     * @param string $pluginPath The plugin path to use.
     * @param string $prefixPath The prefix path to use.
     * @return bool
     */
    protected function _checkMethods($className, $pluginPath = null, $prefixPath = null)
    {
        $excludes = $this->_getCallbacks($className, $pluginPath, $prefixPath);
        $baseMethods = get_class_methods(new Controller);
        $namespace = $this->_getNamespace($className, $pluginPath, $prefixPath);
        $methods = get_class_methods(new $namespace);
        if ($methods == null) {
            $this->err(__d('cake_acl', 'Unable to get methods for {0}', $className));
            return false;
        }
        $actions = array_diff($methods, $baseMethods);
        $actions = array_diff($actions, $excludes);
        foreach ($actions as $key => $action) {
            if (strpos($action, '_', 0) === 0) {
                continue;
            }
            $actions[$key] = $action;
        }

        return $actions;
    }

    /**
     * Get a list of registered callback methods
     *
     * @param string $className The class to reflect on.
     * @param string $pluginPath The plugin path.
     * @param string $prefixPath The prefix path.
     * @return array
     */
    protected function _getCallbacks($className, $pluginPath = null, $prefixPath = null)
    {
        $callbacks = [];
        $namespace = $this->_getNamespace($className, $pluginPath, $prefixPath);
        $reflection = new \ReflectionClass($namespace);
        if ($reflection->isAbstract()) {
            return $callbacks;
        }
        try {
            $method = $reflection->getMethod('implementedEvents');
        } catch (ReflectionException $e) {
            return $callbacks;
        }
        if (version_compare(phpversion(), '5.4', '>=')) {
            $object = $reflection->newInstanceWithoutConstructor();
        } else {
            $object = unserialize(
                sprintf('O:%d:"%s":0:{}', strlen($className), $className)
            );
        }
        $implementedEvents = $method->invoke($object);
        foreach ($implementedEvents as $event => $callable) {
            if (is_string($callable)) {
                $callbacks[] = $callable;
            }
            if (is_array($callable) && isset($callable['callable'])) {
                $callbacks[] = $callable['callable'];
            }
        }
        return $callbacks;
    }

    /**
     * Get the namespace for a given class.
     *
     * @param string $className The class you want a namespace for.
     * @param string $pluginPath The plugin path.
     * @param string $prefixPath The prefix path.
     * @return string
     */
    protected function _getNamespace($className, $pluginPath = null, $prefixPath = null)
    {
        $namespace = preg_replace('/(.*)Controller\//', '', $className);
        $namespace = preg_replace('/\//', '\\', $namespace);
        $namespace = preg_replace('/\.php/', '', $namespace);
        $prefixPath = preg_replace('/\//', '\\', Inflector::camelize($prefixPath));
        if (!$pluginPath) {
            $rootNamespace = Configure::read('App.namespace');
        } else {
            $rootNamespace = preg_replace('/\//', '\\', $pluginPath);
        }
        $namespace = [
            $rootNamespace,
            'Controller',
            $prefixPath,
            $namespace
        ];
        return implode('\\', Hash::filter($namespace));
    }

    /**
     * Returns the aliased name for the plugin (Needed in order to correctly handle nested plugins)
     *
     * @param string $plugin The name of the plugin to alias
     * @return string
     */
    protected function _pluginAlias($plugin)
    {
        return preg_replace('/\//', '\\', Inflector::camelize($plugin));
    }
}