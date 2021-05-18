<?php

namespace Ozdemir\Analytics;

use Ozdemir\Analytics\Interfaces\RequestInterface;
use ArrayIterator;
use Google\Analytics\Data\V1beta\RunReportRequest;

/**
 * Class RequestCollection
 * @package Ozdemir\Analytics
 */
class RequestCollection extends ArrayIterator
{
    /**
     * @var array
     */
    private $reports;

    /**
     * @param  ResponseObject[]  $array
     * @param  int  $flags
     */
    public function __construct(array $array = [], $flags = 0)
    {
        $this->reports = $array;

        $array = array_map(static function (RequestInterface $request): ResponseObject {
            return new ResponseObject($request);
        }, $array);

        parent::__construct($array, $flags);
    }

    /**
     * @return RunReportRequest[]
     */
    public function getReports(): array
    {
        return array_map(static function (RequestInterface $request) {
            return $request->getReportRequest();
        }, $this->reports);
    }

    /**
     * @param $index
     * @return ResponseObject
     */
    public function get($index): ResponseObject
    {
        return $this->offsetGet($index);
    }


}
