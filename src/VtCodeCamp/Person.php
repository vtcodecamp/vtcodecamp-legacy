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
    private $firstName;

    /**
     * @var string
     */
    private $lastName;

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
     * Get First Name
     * 
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set First Name
     * 
     * @param string $value
     * @return VtCodeCamp\Person
     */
    public function setFirstName($value)
    {
        $this->firstName = (string)$value;
        return $this;
    }

    /**
     * Get Last Name
     * 
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set Last Name
     * 
     * @param string $value
     * @return VtCodeCamp\Person
     */
    public function setLastName($value)
    {
        $this->lastName = (string)$value;
        return $this;
    }

    public function getFullName()
    {
        return $this->getFirstName() . ' ' . $this->getLastName();
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
            '_id'    => $this->getId(),
        );
        if (null !== $this->getFirstName()) {
            $array['first_name'] = $this->getFirstName();
        }
        if (null !== $this->getLastName()) {
            $array['last_name'] = $this->getLastName();
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
        $person = new Person($array['_id']);
        if (isset($array['first_name'])) {
            $person->setFirstName($array['first_name']);
        }
        if (isset($array['last_name'])) {
            $person->setLastName($array['last_name']);
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
