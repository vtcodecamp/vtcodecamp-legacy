<?php

namespace VtCodeCampTest;

use VtCodeCamp\Session,
    VtCodeCamp\Text\Markdown,
    VtCodeCamp\Event,
    VtCodeCamp\Track,
    VtCodeCamp\Space,
    DateTime,
    VtCodeCamp\TimePeriod,
    VtCodeCamp\Person;

class SessionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var integer
     */
    private $sessionId;

    /**
     * @var VtCodeCamp\Session
     */
    private $session;

    public function setUp()
    {
        $this->sessionId = uniqid();
        $this->session = new Session($this->sessionId);
    }

    public function testIdentity()
    {
        $this->assertEquals($this->sessionId, $this->session->getId());
    }

    public function testTitle()
    {
        $title = 'HTML5 – A Practical First Look';
        $this->session->setTitle($title);
        $this->assertEquals($title, $this->session->getTitle());
    }

    public function testDescription()
    {
        $text = <<<'EOD'
It seems that HTML5 (or at least discussion of it) is everywhere these days. 
Let’s delve into why it, and related web standards, are getting so much 
attention. We’ll look at HTML5′s new options and elements as well as other 
specifications like CSS3, ECMAScript5, SVG, and beyond. And because knowing 
what’s new is only half the battle, we’ll also discuss practical techniques for 
implementing features today while accommodating a variety of browsers and 
clients that may not fully support these new options.

Resources: 
[http://blogs.msdn.com/b/cbowen/archive/2011/07/13/list-of-html5-presentation-resources.aspx](http://blogs.msdn.com/b/cbowen/archive/2011/07/13/list-of-html5-presentation-resources.aspx)
EOD;
        $description = new Markdown($text);
        $this->session->setDescription($description);
        $this->assertEquals($description, $this->session->getDescription());
    }

    public function testEvent()
    {
        $event = new Event('Vermont Code Camp 2011');
        $this->session->setEvent($event);
        $this->assertEquals($event, $this->session->getEvent());
    }

    public function testTrack()
    {
        $track = new Track('.NET');
        $this->session->setTrack($track);
        $this->assertEquals($track, $this->session->getTrack());
    }

    public function testSpace()
    {
        $space = new Space('Room 1');
        $this->session->setSpace($space);
        $this->assertEquals($space, $this->session->getSpace());
    }

    public function testTimePeriod()
    {
        $timePeriod = new TimePeriod(
            new DateTime('2011-09-10 08:00:00.000 EDT'),
            new DateTime('2011-09-10 08:45:00.000 EDT')
        );
        $this->session->setTimePeriod($timePeriod);
        $this->assertEquals($timePeriod, $this->session->getTimePeriod());
    }

    public function testSpeakers()
    {
        $person = new Person(uniqid());
        $person->setName('Chris Bowen')->setTwitterUsername('ChrisBowen');
        $this->session->addSpeaker($person);
        $this->assertContains($person, $this->session->getSpeakers());
    }
}
