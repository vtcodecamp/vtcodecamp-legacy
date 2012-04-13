<?php

namespace VtCodeCamp;

use VtCodeCamp\Text,
    VtCodeCamp\Event,
    VtCodeCamp\Track,
    VtCodeCamp\Space,
    VtCodeCamp\TimePeriod,
    VtCodeCamp\Person;

/**
 * @category    VtCodeCamp
 * @package     VtCodeCamp_Session
 */
class Session
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var VtCodeCamp\Text
     */
    private $description;

    /**
     * @var VtCodeCamp\Event
     */
    private $event;

    /**
     * @var VtCodeCamp\Track
     */
    private $track;

    /**
     * @var VtCodeCamp\Space
     */
    private $space;

    /**
     * @var VtCodeCamp\TimePeriod
     */
    private $timePeriod;

    /**
     * @var array <VtCodeCamp\Person>
     */
    private $speakers = array();

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
     * Get Title
     * 
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set Title
     * 
     * @param string $value
     */
    public function setTitle($value)
    {
        $this->title = (string)$value;
    }

    /**
     * Get Description
     * 
     * @return VtCodeCamp\Text
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set Description
     * 
     * @param VtCodeCamp\Text $value
     */
    public function setDescription(Text $value)
    {
        $this->description = $value;
    }

    /**
     * Get Event
     * 
     * @return VtCodeCamp\Event
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * Set Event
     * 
     * @param VtCodeCamp\Event $value
     */
    public function setEvent(Event $value)
    {
        $this->event = $value;
    }

    /**
     * Get Track
     * 
     * @return VtCodeCamp\Track
     */
    public function getTrack()
    {
        return $this->track;
    }

    /**
     * Set Track
     * 
     * @param VtCodeCamp\Track $value
     */
    public function setTrack(Track $value)
    {
        $this->track = $value;
    }

    /**
     * Get Space
     * 
     * @return VtCodeCamp\Space
     */
    public function getSpace()
    {
        return $this->space;
    }

    /**
     * Set Space
     * 
     * @param VtCodeCamp\Space $value
     */
    public function setSpace(Space $value)
    {
        $this->space = $value;
    }

    /**
     * Get Time Period
     * 
     * @return VtCodeCamp\TimePeriod
     */
    public function getTimePeriod()
    {
        return $this->timePeriod;
    }

    /**
     * Set Time Period
     * 
     * @param VtCodeCamp\TimePeriod $value
     */
    public function setTimePeriod(TimePeriod $value)
    {
        $this->timePeriod = $value;
    }

    /**
     * Get Speakers
     * 
     * @return array <VtCodeCamp\Person>
     */
    public function getSpeakers()
    {
        return $this->speakers;
    }

    /**
     * Add Speaker
     * 
     * @param VtCodeCamp\Person $value
     */
    public function addSpeaker(Person $value)
    {
        $this->speakers[] = $value;
    }
}
