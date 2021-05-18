<?php


namespace Ozdemir\Analytics\Responses;


use Ozdemir\Analytics\Interfaces\ResponseInterface;

/**
 * Class AbstractResponse
 * @package Ozdemir\Analytics\Responses
 */
abstract class AbstractResponse implements ResponseInterface
{
    /**
     * @return array
     */
    abstract public function toChartJs(): array;

    /**
     * @return string
     */
    abstract public function toJson(): string;

}
