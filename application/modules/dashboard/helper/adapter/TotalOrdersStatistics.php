<?php

namespace Modules\Dashboard\Helper\Adapter;

use Modules\Dashboard\Helper\Statistics;

class TotalOrdersStatistics extends Statistics
{
    public function getStatistics($from, $to)
    {
        return $this->model->getTotalOrders();
    }

}