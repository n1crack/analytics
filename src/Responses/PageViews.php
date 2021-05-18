<?php

namespace Ozdemir\Analytics\Responses;

use Ozdemir\Analytics\Interfaces\ResponseInterface;
use Ozdemir\Analytics\ResponseObject;

/**
 * Class PageViews
 * @package Ozdemir\Analytics\Responses
 */
class PageViews implements ResponseInterface
{
    private $responseObject;

    /**
     * PageViews constructor.
     * @param  ResponseObject  $responseObject
     */
    public function __construct(ResponseObject $responseObject)
    {
        $this->responseObject = $responseObject;
    }

    /**
     * @return array
     */
    public function toChartJs(): array
    {
        return [
            'labels' => array_map(static function ($item) {
                return  date_create_from_format('Ymd', $item[0])->format('d.m.Y');
            }, $this->responseObject->getDimensionValues()),
            'datasets' => [
                [
                    "label" => "Page Views",
                    "data" => array_map(static function ($item) {
                        return $item[0];
                    },$this->responseObject->getMetricValues()),
                ],
            ],
        ];
    }

    /**
     * @return string
     */
    public function toJson(): string
    {
        return $this->responseObject->getReportsResponse()->serializeToJsonString();
    }
}

