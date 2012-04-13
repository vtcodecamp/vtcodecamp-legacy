<?php

namespace VtCodeCampTest;

use VtCodeCamp\Event;

class EventTest extends \PHPUnit_Framework_TestCase
{
    public function testName()
    {
        $name = 'Vermont Code Camp 2011';
        $event = new Event($name);
        $this->assertEquals($name, $event->getName());
    }
}
