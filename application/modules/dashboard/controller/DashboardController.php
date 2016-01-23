<?php

namespace Modules\Dashboard\Controller;

use Controller\Controller;
use Modules\Dashboard\Model\Dashboard;

class DashboardController extends Controller
{
    public function init()
    {
        $this->model = new Dashboard();
    }

    public function indexAction()
    {
        var_dump($this->model->getTopCustomers());
        $this->view->set('name', 'Deividas');
    }
}