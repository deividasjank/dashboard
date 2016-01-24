<?php

namespace Modules\Dashboard\Helper;

use Modules\Dashboard\Model\Dashboard;

abstract class Statistics implements StatisticsInterface
{
    /**
     * @var Dashboard
     */
    protected $model;

    /**
     * Statistics constructor.
     * @param Dashboard $model
     */
    public function __construct(Dashboard $model)
    {
        $this->model = $model;
    }

}