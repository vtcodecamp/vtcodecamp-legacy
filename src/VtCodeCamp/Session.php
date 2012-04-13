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
        $this->id = (string)$id;
    }

    /**
     * Get ID
     * 
     * @return string
     */
    public function getId()
    {
        return $this->id;
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
     * @return VtCodeCamp\Session
     */
    public function setTitle($value)
    {
        $this->title = (string)$value;
        return $this;
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
     * @return VtCodeCamp\Session
     */
    public function setDescription(Text $value)
    {
        $this->description = $value;
        return $this;
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
     * @return VtCodeCamp\Session
     */
    public function setEvent(Event $value)
    {
        $this->event = $value;
        return $this;
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
     * @return VtCodeCamp\Session
     */
    public function setTrack(Track $value)
    {
        $this->track = $value;
        return $this;
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
     * @return VtCodeCamp\Session
     */
    public function setSpace(Space $value)
    {
        $this->space = $value;
        return $this;
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
     * @return VtCodeCamp\Session
     */
    public function setTimePeriod(TimePeriod $value)
    {
        $this->timePeriod = $value;
        return $this;
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
     * @return VtCodeCamp\Session
     */
    public function addSpeaker(Person $value)
    {
        $this->speakers[] = $value;
        return $this;
    }
}
