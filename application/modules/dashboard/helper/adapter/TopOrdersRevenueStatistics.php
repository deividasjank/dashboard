<?php

namespace Modules\Dashboard\Helper\Adapter;

use Modules\Dashboard\Helper\Statistics;

class TopOrdersRevenueStatistics extends Statistics
{
    public function getStatistics($from, $to)
    {
        return $this->model->getTopOrdersByRevenue($from, $to);
    }

}