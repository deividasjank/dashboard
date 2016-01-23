<?php

namespace View;

class View
{
    protected $variables = [];
    protected $module;
    protected $controller;
    protected $action;

    /**
     * @param $module
     * @param $controller
     * @param $action
     */
    function __construct($module, $controller, $action)
    {
        $this->module = $module;
        $this->controller = $controller;
        $this->action = $action;
    }

    /**
     * @param $name
     * @param $value
     */
    public function set($name, $value)
    {
        $this->variables[$name] = $value;
    }

    /**
     * Render Controller view
     */
    public function render()
    {
        extract($this->variables);
        include dirname(__FILE__) . '/../modules/' . $this->module . '/view/' .
            $this->controller . '/' . $this->action . '.php';
    }

}