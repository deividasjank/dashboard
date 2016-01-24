<?php

namespace Modules\Dashboard\Helper\Adapter;

use Modules\Dashboard\Helper\Statistics;

class TopOrdersRevenueStatistics extends Statistics
{
    public function getStatistics($from, $to)
    {
        $data = $this->model->getTopOrdersByRevenue($from, $to);

        foreach ($data as &$row) {
            $row['revenue'] = number_format($row['revenue'], '2', '.', '');
        }

        return $data;
    }

}