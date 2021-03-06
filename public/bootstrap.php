<?php

require_once (ROOT . '/config/config.php');

/**
 * Call required controller action
 */
function call()
{
    parse_str(parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY), $_REQUEST['params']);
    $urlParts = explode('/', $_GET['url']);
    $module = isset($urlParts[0]) ? $urlParts[0] : '';
    $controllerName = isset($urlParts[1]) ? $urlParts[1] : '';
    $actionName = isset($urlParts[2]) ? $urlParts[2] : '';

    $controller = str_replace('-', '', ucwords($controllerName, '-'));
    $controller .= 'Controller';
    $action = $actionName . 'action';

    $classNamespace = implode('\\', ['Modules', ucfirst($module), 'Controller', $controller]);

    if (!class_exists($classNamespace)) {
        echo 'Not found.';
        exit;
    }
    $dispatch = new $classNamespace($module, $controllerName, $actionName);

    if (!method_exists($dispatch, $action)) {
        echo 'Not found.';
        exit;
    }
    call_user_func_array(array($dispatch, $action), []);
}

/**
 * Autoload files PSR-4 namespace
 *
 * @param $class
 */
function __autoload($class)
{
    $base = ROOT . '/application';
    $parts = explode('\\', $class);
    $numItems = count($parts);
    $i = 0;
    foreach ($parts as $part) {
        if (++$i === $numItems) {
            $base .= '/' . $part;
        } else {
            $base .= '/' . strtolower($part);
        }
    }
    require_once($base . '.php');
}

call();