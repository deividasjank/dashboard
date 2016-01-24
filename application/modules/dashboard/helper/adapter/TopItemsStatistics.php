<?php

namespace Modules\Dashboard\Helper\Adapter;

use Modules\Dashboard\Helper\Statistics;

class TopItemsStatistics extends Statistics
{
    public function getStatistics($from, $to)
    {
        return $this->model->getTopSellingItems($from, $to);
    }

}