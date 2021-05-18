<?php

namespace Ozdemir\Analytics\Requests;

use Ozdemir\Analytics\Period;
use Ozdemir\Analytics\Interfaces\RequestInterface;
use Google\Analytics\Data\V1beta\DateRange;
use Google\Analytics\Data\V1beta\Dimension;
use Google\Analytics\Data\V1beta\Metric;
use Google\Analytics\Data\V1beta\OrderBy;
use Google\Analytics\Data\V1beta\OrderBy\DimensionOrderBy;
use Google\Analytics\Data\V1beta\RunReportRequest;

/**
 * Class PageViewsAndUsers
 * @package Ozdemir\Analytics\Requests
 */
class PageViewsAndUsers implements RequestInterface
{
    /**
     * @var RunReportRequest
     */
    public $request;

    /**
     * @var string
     */
    public $responseClass = \Ozdemir\Analytics\Responses\PageViewsAndUsers::class;

    /**
     * PageViewsAndUsers constructor.
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
                            'name' => 'date',
                        ]
                    ),
                ],
                'metrics' => [
                    new Metric(
                        [
                            'name' => 'totalUsers',
                        ]
                    ),
                    new Metric(
                        [
                            'name' => 'screenPageViews',
                        ]
                    ),
                ],
                'order_bys' => [
                    new OrderBy([
                        'dimension' => new DimensionOrderBy(
                            ['dimension_name' => 'date']
                        ),
                    ]),
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

