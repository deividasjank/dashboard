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
        $from = strtotime('first day of last month 00:00:00');
        //$to = strtotime('last day of last month 23:59:59');
        $to = time();
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
        $this->view->set('data', $data);
    }
}