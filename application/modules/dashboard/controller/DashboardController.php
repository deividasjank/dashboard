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
        $from = strtotime('first day of last month 00:00:00');
        $to = strtotime('last day of last month 23:59:59');

        var_dump($this->model->getTopOrdersByItemCount(10, $from, $to));
        $this->view->set('name', 'Deividas');
    }
}