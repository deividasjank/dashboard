<?php

namespace Modules\Dashboard\Helper\Adapter;

use Modules\Dashboard\Helper\Statistics;

class TopOrdersItemCountStatistics extends Statistics
{
    public function getStatistics($from, $to)
    {
        return $this->model->getTopOrdersByItemCount($from, $to);
    }

}