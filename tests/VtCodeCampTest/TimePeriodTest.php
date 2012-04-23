<?php

namespace VtCodeCampTest;

use VtCodeCamp\TimePeriod,
    DateTime;

class TimePeriodTest extends \PHPUnit_Framework_TestCase
{
    public function testStart()
    {
        $start = new DateTime('2011-09-10 08:00:00.000 EDT');
        $end = new DateTime('2011-09-10 08:45:00.000 EDT');
        $timePeriod = new TimePeriod($start, $end);
        $this->assertEquals($start->format('U'), $timePeriod->getStart()->format('U'));
    }

    public function testEnd()
    {
        $start = new DateTime('2011-09-10 08:00:00.000 EDT');
        $end = new DateTime('2011-09-10 08:45:00.000 EDT');
        $timePeriod = new TimePeriod($start, $end);
        $this->assertEquals($end->format('U'), $timePeriod->getEnd()->format('U'));
    }
}
