<?php

namespace VtCodeCamp;

use VtCodeCamp\ArraySerializable,
    VtCodeCamp\Text,
    VtCodeCamp\Text\Markdown;

/**
 * @category    VtCodeCamp
 * @package     VtCodeCamp_Person
 */
class Person implements ArraySerializable
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
     * @return VtCodeCamp\Person
     */
    public function setName($value)
    {
        $this->name = (string)$value;
        return $this;
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
     * @return VtCodeCamp\Person
     */
    public function setTwitterUsername($value)
    {
        $this->twitterUsername = (string)$value;
        return $this;
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
     * @return VtCodeCamp\Person
     */
    public function setBio(Text $value)
    {
        $this->bio = $value;
        return $this;
    }

    public function arraySerialize()
    {
        $array = array(
            'id'    => $this->getId(),
        );
        if (null !== $this->getName()) {
            $array['name'] = $this->getName();
        }
        if (null !== $this->getTwitterUsername()) {
            $array['twitter_username'] = $this->getTwitterUsername();
        }
        if (null !== $this->getBio()) {
            $array['bio'] = $this->getBio()->arraySerialize();
        }
        return $array;
    }

    public static function arrayDeserialize($array)
    {
        $person = new Person($array['id']);
        if (isset($array['name'])) {
            $person->setName($array['name']);
        }
        if (isset($array['twitter_username'])) {
            $person->setTwitterUsername($array['twitter_username']);
        }
        if (isset($array['bio'])) {
            $person->setBio(Markdown::arrayDeserialize($array['bio']));
        }
        return $person;
    }
}
