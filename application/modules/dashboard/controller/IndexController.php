<?php

namespace Modules\Dashboard\Controller;

use Controller\Controller;
use Modules\Dashboard\Model\Order;

class IndexController extends Controller
{
    public function indexAction()
    {
        $model = new Order();
        $model->doSomething();
        $this->view->set('name', 'Deividas');
    }
}