<?php

namespace Modules\Dashboard\Helper\Adapter;

use Modules\Dashboard\Helper\Statistics;

class TopCustomersStatistics extends Statistics
{
    public function getStatistics($from, $to)
    {
        return $this->model->getTopCustomers($from, $to);
    }

}