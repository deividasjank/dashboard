<?php

namespace Controller;

use View\View;

abstract class Controller
{
    protected $module;
    protected $controller;
    protected $action;
    public $view;

    /**
     * @param $module
     * @param $controller
     * @param $action
     */
    public function __construct($module, $controller, $action)
    {
        $this->module = $module;
        $this->controller = $controller;
        $this->action = $action;
        $this->view = new View($module, $controller, $action);

    }

    public function __destruct()
    {
        $this->view->render();
    }
}