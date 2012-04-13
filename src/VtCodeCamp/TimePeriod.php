<?php

namespace VtCodeCamp;

use \DateTime,
    \DateTimeZone;

/**
 * @category    VtCodeCamp
 * @package     VtCodeCamp_TimePeriod
 */
class TimePeriod
{
    /**
     * @var \DateTime
     */
    private $start;

    /**
     * @var \DateTime
     */
    private $end;

    public function __construct(DateTime $start, DateTime $end)
    {
        $this->start = clone $start;
        $this->end = clone $end;
        $timezone = new DateTimeZone('UTC');
        $this->start->setTimezone($timezone);
        $this->end->setTimezone($timezone);
    }

    /**
     * Get Start
     * 
     * @return \DateTime
     */
    public function getStart()
    {
        return clone $this->start;
    }

    /**
     * Get End
     * 
     * @return \DateTime
     */
    public function getEnd()
    {
        return clone $this->end;
    }
}
