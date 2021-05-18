<?php

namespace Ozdemir\Analytics\Responses;

use Ozdemir\Analytics\Interfaces\ResponseInterface;
use Ozdemir\Analytics\ResponseObject;

/**
 * Class TotalUsersByChannels
 * @package Ozdemir\Analytics\Responses
 */
class TotalUsersByChannels implements ResponseInterface
{
    private $responseObject;

    /**
     * TotalUsersByChannels constructor.
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
                return $item[0];
            },$this->responseObject->getDimensionValues()),
            'datasets' => [
                [
                    "label" => "Channels by Total Users",
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

