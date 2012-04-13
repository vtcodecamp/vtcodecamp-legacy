<?php

namespace VtCodeCampTest;

use VtCodeCamp\Track;

class TrackTest extends \PHPUnit_Framework_TestCase
{
    public function testName()
    {
        $name = '.NET';
        $track = new Track($name);
        $this->assertEquals($name, $track->getName());
    }
}
