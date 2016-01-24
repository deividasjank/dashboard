<?php

namespace Modules\Dashboard\Helper\Adapter;

use Modules\Dashboard\Helper\Statistics;

class TotalCustomersStatistics extends Statistics
{
    public function getStatistics($from, $to)
    {
        return $this->model->getTotalCustomers($from, $to);
    }

}