<?php

namespace Controller;

use Model\Model;
use View\View;

abstract class Controller
{
    protected $module;
    protected $controller;
    protected $action;

    /**
     * @var Model
     */
    protected $model;

    /**
     * @var View
     */
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
        $this->init();
    }

    abstract function init();

    public function __destruct()
    {
        $this->view->render();
    }
}