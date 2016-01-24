<?php

namespace Modules\Dashboard\Controller;

use Controller\Controller;
use Modules\Dashboard\Helper\Statistics;
use Modules\Dashboard\Model\Dashboard;

class DashboardController extends Controller
{
    public function init()
    {
        $this->model = new Dashboard();
    }

    public function indexAction()
    {
        if (isset($_REQUEST['params']['from'])) {
            $from = strtotime($_REQUEST['params']['from'] . ' 00:00:00');
        } else {
            $from = strtotime('first day of last month 00:00:00');
        }
        if (isset($_REQUEST['params']['to'])) {
            $to = strtotime($_REQUEST['params']['to'] . ' 23:59:59');
        } else {
            $to = strtotime('last day of last month 23:59:59');
        }
        $data = [];
        if (isset($_REQUEST['params']['type'])) {
            $data['type'] = trim(preg_replace('/[A-Z]/', ' $0', ucfirst($_REQUEST['params']['type'])));
            $adapter = 'Modules\\Dashboard\\Helper\\Adapter\\' . ucfirst($_REQUEST['params']['type']) .  'Statistics';

            if (class_exists($adapter)) {
                /** @var Statistics $statistics */
                $statistics = new $adapter($this->model);
                $data['statistics'] = $statistics->getStatistics($from, $to);
            }
        }
        $this->view->set('from', $from);
        $this->view->set('to', $to);
        $this->view->set('type', isset($_REQUEST['params']['type']) ? $_REQUEST['params']['type'] : '');
        $this->view->set('data', $data);
    }
}