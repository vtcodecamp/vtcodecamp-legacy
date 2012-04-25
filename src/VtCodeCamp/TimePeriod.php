<?php

namespace VtCodeCamp;

use VtCodeCamp\ArraySerializable,
    \DateTime,
    \DateTimeZone;

/**
 * @category    VtCodeCamp
 * @package     VtCodeCamp_TimePeriod
 */
class TimePeriod implements ArraySerializable
{
    /**
     * @var \DateTime
     */
    private $start;

    /**
     * @var \DateTime
     */
    private $end;

    public function __construct(DateTime $start, DateTime $end = null)
    {
        $timezone = new DateTimeZone('UTC');
        $this->start = clone $start;
        $this->start->setTimezone($timezone);
        if (null !== $end) {
            $this->end = clone $end;
            $this->end->setTimezone($timezone);
        }
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
        if (null === $this->end) {
            return null;
        }
        return clone $this->end;
    }

    public function arraySerialize()
    {
        $array = array(
            'start' => $this->getStart()->format('c'),
        );
        if (null !== $this->getEnd()) {
            $array['end'] = $this->getEnd()->format('c');
        }
        return $array;
    }

    public static function arrayDeserialize($array)
    {
        $start = new DateTime($array['start']);
        $end = null;
        if (isset($array['end'])) {
            $end = new DateTime($array['end']);
        }
        return new TimePeriod($start, $end);
    }
}
