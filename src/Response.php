<?php

namespace Ozdemir\Analytics;

use ErrorException;
use Google\Analytics\Data\V1beta\BatchRunReportsResponse;


/**
 * Class Response
 * @package Ozdemir\Analytics
 */
class Response
{
    /**
     * @var RequestCollection
     */
    private $requestCollection;

    /**
     * @var BatchRunReportsResponse
     */
    private $batchRunReportsResponse;


    /**
     * Response constructor.
     * @param  RequestCollection  $requestCollection
     * @param  BatchRunReportsResponse  $batchRunReportsResponse
     */
    public function __construct(RequestCollection $requestCollection, BatchRunReportsResponse $batchRunReportsResponse)
    {
        $this->requestCollection = $requestCollection;
        $this->batchRunReportsResponse = $batchRunReportsResponse;
    }

    /**
     * @return RequestCollection
     */
    public function getRequestCollection(): RequestCollection
    {
        return $this->requestCollection;
    }

    /**
     *
     * @param  int $index
     * @param  string|null  $customResponse
     * @return Interfaces\ResponseInterface
     * @throws ErrorException
     */
    public function get(int $index, string $customResponse = null): Interfaces\ResponseInterface
    {
        $responseObject = $this->getRequestCollection()->get($index);

        $responseObject->setReportsResponse($this->batchRunReportsResponse->getReports()->offsetGet($index));

        if ($customResponse) {
            $responseObject->setResponse(new $customResponse($responseObject));
        }

        return $responseObject->getResponse();
    }


}
