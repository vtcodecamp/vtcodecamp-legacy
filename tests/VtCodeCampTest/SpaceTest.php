<?php

namespace VtCodeCampTest;

use VtCodeCamp\Space;

class SpaceTest extends \PHPUnit_Framework_TestCase
{
    public function testName()
    {
        $name = 'Room 1';
        $space = new Space($name);
        $this->assertEquals($name, $space->getName());
    }
}
