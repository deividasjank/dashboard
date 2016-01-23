<?php

require_once (ROOT . '/config/config.php');
require_once (ROOT . '/application/model/Database.php');

function call()
{

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

call();