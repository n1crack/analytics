<?php

namespace Ozdemir\Analytics\Requests;

use Ozdemir\Analytics\Period;
use Ozdemir\Analytics\Interfaces\RequestInterface;
use Google\Analytics\Data\V1beta\DateRange;
use Google\Analytics\Data\V1beta\Dimension;
use Google\Analytics\Data\V1beta\Metric;
use Google\Analytics\Data\V1beta\RunReportRequest;

/**
 * Class PageViewsByReferer
 * @package Ozdemir\Analytics\Requests
 */
class PageViewsByReferer implements RequestInterface
{

    /**
     * @var RunReportRequest
     */
    public $request;

    /**
     * @var string
     */
    public $responseClass = \Ozdemir\Analytics\Responses\PageViewsByReferer::class;

    /**
     * PageViewsByReferer constructor.
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
                            'name' => 'sessionSource',
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

