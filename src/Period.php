<?php

namespace Ozdemir\Analytics;

use DateInterval;
use DateTime;
use DateTimeInterface;
use Exception;

/**
 * Class Period
 * @package Ozdemir\Analytics
 */
class Period
{
    /**
     * @var DateTimeInterface
     */
    public $startDate;

    /**
     * @var DateTimeInterface
     */
    public $endDate;

    /**
     * Period constructor.
     * @param  DateTimeInterface  $startDate
     * @param  DateTimeInterface  $endDate
     */
    public function __construct(DateTimeInterface $startDate, DateTimeInterface $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    /**
     * @param  DateTimeInterface  $startDate
     * @param  DateTimeInterface  $endDate
     * @return static
     */
    public static function create(DateTimeInterface $startDate, DateTimeInterface $endDate): self
    {
        return new static($startDate, $endDate);
    }

    /**
     * @param  int  $numberOfDays
     * @return static
     * @throws Exception
     */
    public static function days(int $numberOfDays): self
    {
        $startDate = (new DateTime('now'))->sub(new DateInterval("P".$numberOfDays."D"));
        $endDate = (new DateTime('now'));

        return new static($startDate, $endDate);
    }

    /**
     * @param  int  $numberOfMonths
     * @return static
     * @throws Exception
     */
    public static function months(int $numberOfMonths): self
    {
        $startDate = (new DateTime('now'))->sub(new DateInterval("P".$numberOfMonths."M"));
        $endDate = (new DateTime('now'));

        return new static($startDate, $endDate);
    }

    /**
     * @param  int  $numberOfYears
     * @return static
     * @throws Exception
     */
    public static function years(int $numberOfYears): self
    {
        $startDate = (new DateTime('now'))->sub(new DateInterval("P".$numberOfYears."Y"));
        $endDate = (new DateTime('now'));

        return new static($startDate, $endDate);
    }
}
