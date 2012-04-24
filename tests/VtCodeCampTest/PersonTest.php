<?php

namespace VtCodeCampTest;

use VtCodeCamp\Person,
    VtCodeCamp\Text\Markdown;

class PersonTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var integer
     */
    private $personId;

    /**
     * @var VtCodeCamp\Person
     */
    private $person;

    public function setUp()
    {
        $this->personId = uniqid();
        $this->person = new Person($this->personId);
    }

    public function testIdentity()
    {
        $this->assertEquals($this->personId, $this->person->getId());
    }

    public function testFirstName()
    {
        $firstName = 'Chris';
        $this->person->setFirstName($firstName);
        $this->assertEquals($firstName, $this->person->getFirstName());
    }

    public function testLastName()
    {
        $lastName = 'Bowen';
        $this->person->setLastName($lastName);
        $this->assertEquals($lastName, $this->person->getLastName());
    }

    public function testFullName()
    {
        $firstName = 'Chris';
        $lastName = 'Bowen';
        $this->person->setFirstName($firstName);
        $this->person->setLastName($lastName);
        $this->assertEquals($firstName . ' ' . $lastName, $this->person->getFullName());
    }

    public function testTwitterUsername()
    {
        $twitterUsername = 'ChrisBowen';
        $this->person->setTwitterUsername($twitterUsername);
        $this->assertEquals($twitterUsername, $this->person->getTwitterUsername());
    }

    public function testBio()
    {
        $text = <<<'EOD'
[Chris Bowen](http://blogs.msdn.com/cbowen) is a Principal Developer Evangelist 
with Microsoft, specializing in web technologies and working with customers and 
companies in the northeastern US. An architect and developer with over 18 years 
in the industry, he joined Microsoft after holding senior positions at companies 
such as Monster.com, VistaPrint, Staples, and IDX Systems. He is coauthor of 
“Essential Windows Communication Foundation” and “Professional Visual Studio 
2005 Team System” and holds an M.S. in Computer Science and a B.S. in Management 
Information Systems, both from Worcester Polytechnic Institute.
EOD;
        $bio = new Markdown($text);
        $this->person->setBio($bio);
        $this->assertEquals($bio, $this->person->getBio());
    }
}
