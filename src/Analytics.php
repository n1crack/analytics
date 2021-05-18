<?php

namespace Ozdemir\Analytics;

use Exception;
use Google\Analytics\Data\V1beta\BetaAnalyticsDataClient;
use Google\ApiCore\ApiException;
use Google\ApiCore\ValidationException;

/**
 * Class Analytics
 * @package Ozdemir\Analytics
 */
class Analytics
{
    /**
     * @var BetaAnalyticsDataClient
     */
    public $client;

    /**
     * @var
     */
    public $property;

    /**
     * Analytics constructor.
     * @param  array  $config
     * @throws ValidationException
     * @throws Exception
     */
    public function __construct(array $config = [])
    {

        if (isset($config['property'])) {
            $this->setProperty($config['property']);
        } else {
            throw new Exception("Property Id does not defined.");
        }

        if (isset($config['credentials'])) {
            $credentials = $config['credentials'];
        } else {
            throw new Exception("Credentials does not defined.");
        }

        $this->client = new BetaAnalyticsDataClient([
            'credentials' => $credentials,
        ]);
    }

    /**
     * @param  array  $requests
     * @return Response
     * @throws ApiException
     */
    public function fetch(array $requests = []): Response
    {
        $requestCollection = new RequestCollection($requests);

        $reports = $this->client->batchRunReports([
            'property' => 'properties/'.$this->getProperty(),
            'requests' => $requestCollection->getReports(),
        ]);

        return new Response($requestCollection, $reports);
    }

    /**
     * Set the value of property
     *
     * @param $property
     * @return  self
     */
    public function setProperty($property): Analytics
    {
        $this->property = $property;

        return $this;
    }

    /**
     * Get the value of property
     */
    public function getProperty()
    {
        return $this->property;
    }
}
