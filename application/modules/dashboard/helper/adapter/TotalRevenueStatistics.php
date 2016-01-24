<?php

namespace Modules\Dashboard\Helper\Adapter;

use Modules\Dashboard\Helper\Statistics;

class TotalRevenueStatistics extends Statistics
{
    public function getStatistics($from, $to)
    {
        $data = $this->model->getTotalRevenue($from, $to);
        $data[0]['total_revenue'] = number_format($data[0]['total_revenue'], 2, '.', '');

        return $data;
    }

}