<?php

namespace VtCodeCamp;

use VtCodeCamp\Text,
    VtCodeCamp\Text\Markdown,
    VtCodeCamp\Event,
    VtCodeCamp\Track,
    VtCodeCamp\Space,
    VtCodeCamp\TimePeriod,
    VtCodeCamp\Person,
    VtCodeCamp\ArraySerializable;

/**
 * @category    VtCodeCamp
 * @package     VtCodeCamp_Session
 */
class Session implements ArraySerializable
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $rev;

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
     * Get Rev
     * 
     * @return string
     */
    public function getRev()
    {
        return $this->rev;
    }

    /**
     * Set Rev
     * 
     * @param string $value
     * @return VtCodeCamp\Session
     */
    public function setRev($value)
    {
        $this->rev = (string)$value;
        return $this;
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

    public function arraySerialize()
    {
        $array = array(
            '_id'    => $this->getId(),
        );
        if (null !== $this->getRev()) {
            $array['_rev'] = $this->getRev();
        }
        if (null !== $this->getTitle()) {
            $array['title'] = $this->getTitle();
        }
        if (null !== $this->getDescription()) {
            $array['description'] = $this->getDescription()->arraySerialize();
        }
        if (null !== $this->getEvent()) {
            $array['event'] = $this->getEvent()->arraySerialize();
        }
        if (null !== $this->getTrack()) {
            $array['track'] = $this->getTrack()->arraySerialize();
        }
        if (null !== $this->getSpace()) {
            $array['space'] = $this->getSpace()->arraySerialize();
        }
        if (null !== $this->getTimePeriod()) {
            $array['time_period'] = $this->getTimePeriod()->arraySerialize();
        }
        $speakers = $this->getSpeakers();
        if (count($speakers) > 0) {
			/* @var $speaker VtCodeCamp\Person */
            foreach ($speakers as $speaker) {
                $array['speakers'][] = $speaker->arraySerialize();
            }
        }
        return $array;
    }

    public static function arrayDeserialize($array)
    {
        $session = new Session($array['_id']);
        if (isset($array['_rev'])) {
            $session->setRev($array['_rev']);
        }
        if (isset($array['title'])) {
            $session->setTitle($array['title']);
        }
        if (isset($array['description'])) {
            $session->setDescription(Markdown::arrayDeserialize($array['description']));
        }
        if (isset($array['event'])) {
            $session->setEvent(Event::arrayDeserialize($array['event']));
        }
        if (isset($array['track'])) {
            $session->setTrack(Track::arrayDeserialize($array['track']));
        }
        if (isset($array['space'])) {
            $session->setSpace(Space::arrayDeserialize($array['space']));
        }
        if (isset($array['time_period'])) {
            $session->setTimePeriod(TimePeriod::arrayDeserialize($array['time_period']));
        }
        if (isset($array['speakers'])) {
            foreach ($array['speakers'] as $speakerArray) {
                $session->addSpeaker(Person::arrayDeserialize($speakerArray));
            }
        }
        return $session;
    }
}
