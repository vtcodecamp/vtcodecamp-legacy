<?php

namespace VtCodeCamp;

use VtCodeCamp\ArraySerializable;

/**
 * @category    VtCodeCamp
 * @package     VtCodeCamp_Track
 */
class Track implements ArraySerializable
{
    /**
     * @var string
     */
    private $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * Get Name
     * 
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    public function arraySerialize()
    {
        return array(
            'name'  => $this->getName(),
        );
    }

    public static function arrayDeserialize($array)
    {
        $name = $array['name'];
        return new Track($name);
    }
}
