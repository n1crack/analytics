<?php

namespace Ozdemir\Analytics;

use Ozdemir\Analytics\Interfaces\RequestInterface;
use Ozdemir\Analytics\Interfaces\ResponseInterface;
use Google\Analytics\Data\V1beta\DimensionValue;
use Google\Analytics\Data\V1beta\MetricValue;
use Google\Analytics\Data\V1beta\Row;
use Google\Analytics\Data\V1beta\RunReportResponse;

/**
 * Class ResponseObject
 * @package Ozdemir\Analytics
 */
class ResponseObject
{
    /**
     * @var RequestInterface
     */
    public $request;

    /**
     * @var ResponseInterface
     */
    public $response;


    /**
     * @var RunReportResponse
     */
    private $reportsResponse;

    /**
     * ResponseObject constructor.
     * @param $request
     */
    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * @return array
     */
    public function getDimensionValues(): array
    {
        $data = [];

        $rows = $this->reportsResponse->getRows();

        foreach ($rows as $key => $row) {
            foreach ($row->getDimensionValues() as $item) {
                $data[$key][] = $item->getValue();
            }
        }

        return $data;
    }

    /**
     *
     * @return array
     */
    public function getMetricValues(): array
    {
        $data = [];

        $rows = $this->reportsResponse->getRows();

        foreach ($rows as $key => $row) {
            foreach ($row->getMetricValues() as $item) {
                $data[$key][] = $item->getValue();
            }
        }

        return $data;
    }

    /**
     * @return ResponseInterface
     */
    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }


    /**
     * @param  ResponseInterface  $response
     */
    public function setResponse(ResponseInterface $response): void
    {
        $this->response = $response;
    }

    /**
     * @param $reportsResponse
     */
    public function setReportsResponse($reportsResponse): void
    {
        $responseClass = $this->request->responseClass;
        $this->response = new $responseClass($this);

        $this->setResponse($this->response);

        $this->reportsResponse = $reportsResponse;
    }

    /**
     * @return RunReportResponse
     */
    public function getReportsResponse(): RunReportResponse
    {
        return $this->reportsResponse;
    }

    /**
     * @return RequestInterface
     */
    public function getRequest(): RequestInterface
    {
        return $this->request;
    }
}
