<?php

namespace VtCodeCampTest;

use VtCodeCamp\Session,
    VtCodeCamp\Text\Markdown,
    VtCodeCamp\Event,
    VtCodeCamp\Track,
    VtCodeCamp\Space,
    DateTime,
    VtCodeCamp\TimePeriod,
    VtCodeCamp\Person,
    VtCodeCampTest\SessionRepository;

class SessionRepositoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var VtCodeCamp\Session
     */
    private $session;

    /**
     * @var VtCodeCamp\SessionRepository
     */
    private $sessionRepository;

    public function setUp()
    {
        $this->session = new Session(uniqid());
        $sessionDescriptionText = <<<'EOD'
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
        $sessionSpeakerBioText = <<<'EOD'
[Chris Bowen](http://blogs.msdn.com/cbowen) is a Principal Developer Evangelist 
with Microsoft, specializing in web technologies and working with customers and 
companies in the northeastern US. An architect and developer with over 18 years 
in the industry, he joined Microsoft after holding senior positions at companies 
such as Monster.com, VistaPrint, Staples, and IDX Systems. He is coauthor of 
“Essential Windows Communication Foundation” and “Professional Visual Studio 
2005 Team System” and holds an M.S. in Computer Science and a B.S. in Management 
Information Systems, both from Worcester Polytechnic Institute.
EOD;
        $sessionSpeaker = new Person(uniqid());
        $sessionSpeaker
            ->setName('Chris Bowen')
            ->setTwitterUsername('ChrisBowen')
            ->setBio(new Markdown($sessionSpeakerBioText));
        $this->session
            ->setTitle('HTML5 – A Practical First Look')
            ->setDescription(new Markdown($sessionDescriptionText))
            ->setEvent(new Event('Vermont Code Camp 2011'))
            ->setTrack(new Track('.NET'))
            ->setSpace(new Space('Room 1'))
            ->setTimePeriod(new TimePeriod(
                new DateTime('2011-09-10 10:15:00.000 EDT'),
                new DateTime('2011-09-10 11:15:00.000 EDT')
            ))
            ->addSpeaker($sessionSpeaker);
        $this->sessionRepository = new SessionRepository();
    }

    public function testPostAndGet()
    {
        $this->sessionRepository->post($this->session);
        $session = $this->sessionRepository->get($this->session->getId());
        $this->assertEquals($this->session, $session);
    }

    public function testPutAndGet()
    {
        $this->sessionRepository->put($this->session);
        $session = $this->sessionRepository->get($this->session->getId());
        $this->assertEquals($this->session, $session);
    }

    public function testPostAndDelete()
    {
        $this->sessionRepository->post($this->session);
        $this->sessionRepository->delete($this->session);
        $this->setExpectedException('VtCodeCamp\Exception\ClientError\NotFound');
        $session = $this->sessionRepository->get($this->session->getId());
    }

    public function testPostTwice()
    {
        $this->sessionRepository->post($this->session);
        $this->setExpectedException('VtCodeCamp\Exception\ClientError\Conflict');
        $this->sessionRepository->post($this->session);
    }

    public function testPostAndPut()
    {
        $this->sessionRepository->post($this->session);
        $this->sessionRepository->put($this->session);
    }

    public function testPostAndPutConflict()
    {
        $originalSession = clone $this->session;
        $this->sessionRepository->post($this->session);
        $this->setExpectedException('VtCodeCamp\Exception\ClientError\Conflict');
        $this->sessionRepository->put($originalSession);
    }
}
