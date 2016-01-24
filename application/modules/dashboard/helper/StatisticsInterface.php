<?php

namespace Modules\Dashboard\Helper;

interface StatisticsInterface
{
    public function getStatistics($from, $to);
}