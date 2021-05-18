<?php

namespace Ozdemir\Analytics\Requests;

use Ozdemir\Analytics\Period;
use Ozdemir\Analytics\Interfaces\RequestInterface;
use Google\Analytics\Data\V1beta\DateRange;
use Google\Analytics\Data\V1beta\Dimension;
use Google\Analytics\Data\V1beta\Metric;
use Google\Analytics\Data\V1beta\RunReportRequest;

/**
 * Class PageViewsByCountry
 * @package Ozdemir\Analytics\Requests
 */
class PageViewsByCountry implements RequestInterface
{

    /**
     * @var RunReportRequest
     */
    public $request;

    /**
     * @var string
     */
    public $responseClass = \Ozdemir\Analytics\Responses\PageViewsByCountry::class;

    /**
     * PageViewsByCountry constructor.
     * @param  Period  $period
     * @param  int  $limit
     */
    public function __construct(Period $period, int $limit = 10000)
    {

        $this->request = new RunReportRequest(
            [
                'date_ranges' => [
                    new DateRange([
                        'start_date' => $period->startDate->format("Y-m-d"),
                        'end_date' => $period->endDate->format("Y-m-d"),
                    ]),
                ],
                'dimensions' => [
                    new Dimension(
                        [
                            'name' => 'country',
                        ]
                    ),
                ],
                'metrics' => [
                    new Metric(
                        [
                            'name' => 'screenPageViews',
                        ]
                    ),
                ],
                'limit' => $limit
            ]
        );
    }

    /**
     * @return RunReportRequest
     */
    public function getReportRequest(): RunReportRequest
    {
        return $this->request;
    }

}

