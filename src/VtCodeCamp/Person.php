<?php

namespace VtCodeCamp;

use VtCodeCamp\Text;

/**
 * @category    VtCodeCamp
 * @package     VtCodeCamp_Person
 */
class Person
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $twitterUsername;

    /**
     * @var VtCodeCamp\Text
     */
    private $bio;

    public function __construct($id)
    {
        $this->_id = (string)$id;
    }

    /**
     * Get ID
     * 
     * @return string
     */
    public function getId()
    {
        return $this->_id;
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

    /**
     * Set Name
     * 
     * @param string $value
     */
    public function setName($value)
    {
        $this->name = (string)$value;
    }

    /**
     * Get Twitter Username
     * 
     * @return string
     */
    public function getTwitterUsername()
    {
        return $this->twitterUsername;
    }

    /**
     * Set Twitter Username
     * 
     * @param string $value
     */
    public function setTwitterUsername($value)
    {
        $this->twitterUsername = (string)$value;
    }

    /**
     * Get Bio
     * 
     * @return VtCodeCamp\Text
     */
    public function getBio()
    {
        return $this->bio;
    }

    /**
     * Set Bio
     * 
     * @param VtCodeCamp\Text $value
     */
    public function setBio(Text $value)
    {
        $this->bio = $value;
    }
}
