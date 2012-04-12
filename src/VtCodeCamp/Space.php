<?php

namespace VtCodeCamp;

/**
 * @category    VtCodeCamp
 * @package     VtCodeCamp_Space
 */
class Space
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
}
