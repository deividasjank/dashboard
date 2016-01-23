<?php

namespace Modules\Dashboard\Controller;

use Controller\Controller;

class IndexController extends Controller
{
    public function indexAction() {
        $this->view->set('name', 'Deividas');
    }
}