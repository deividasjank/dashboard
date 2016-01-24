<?php

namespace Modules\Dashboard\Helper\Adapter;

use Modules\Dashboard\Helper\Statistics;

class TotalRevenueStatistics extends Statistics
{
    public function getStatistics($from, $to)
    {
        return $this->model->getTotalRevenue($from, $to);
    }

}