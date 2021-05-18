<?php

namespace Ozdemir\Analytics\Interfaces;

use Ozdemir\Analytics\Period;
use Google\Analytics\Data\V1beta\RunReportRequest;

/**
 * Interface RequestInterface
 * @package Ozdemir\Analytics
 */
interface RequestInterface
{

    /**
     * RequestInterface constructor.
     * @param  Period  $period
     * @param  int  $limit
     */
    public function __construct(Period $period, int $limit = 10000);

    /**
     * @return RunReportRequest
     */
    public function getReportRequest(): RunReportRequest;

}
