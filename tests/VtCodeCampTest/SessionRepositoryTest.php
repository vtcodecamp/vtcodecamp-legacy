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
    Doctrine\CouchDB\CouchDBClient,
    Doctrine\CouchDB\View\FolderDesignDocument,
    VtCodeCamp\SessionRepository;

class SessionRepositoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var VtCodeCamp\Session
     */
    private $session;

    /**
     * @var string
     */
    private $testDbName;

    /**
     * @var Doctrine\CouchDB\CouchDBClient
     */
    private $couchDbClient;

    /**
     * @var VtCodeCamp\SessionRepository
     */
    private $sessionRepository;

    private function createCouchDbViews()
    {
        $dir = new \DirectoryIterator(APPLICATION_ROOT . '/couch');
        foreach ($dir as $fileinfo) {
            if (!$fileinfo->isDot()) {
                $designDoc = new FolderDesignDocument($fileinfo->getPathname());
                $this->couchDbClient->createDesignDocument($fileinfo->getFilename(), $designDoc);
            }
        }
    }

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
            ->setFirstName('Chris')
            ->setLastName('Bowen')
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
        //TODO: Configure Sag
        $this->testDbName = uniqid('test_');
        $this->couchDbClient = CouchDBClient::create(array(
            'dbname'    => $this->testDbName,
        ));
        $this->couchDbClient->createDatabase($this->testDbName);
        $this->createCouchDbViews();
        $this->sessionRepository = new SessionRepository($this->couchDbClient);
    }

    public function tearDown()
    {
        $this->couchDbClient->deleteDatabase($this->testDbName);
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
        $originalSession = clone $this->session;
        $this->sessionRepository->post($this->session);
        $this->setExpectedException('VtCodeCamp\Exception\ClientError\Conflict');
        $this->sessionRepository->post($originalSession);
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

    public function testIndexByEventAndSpace()
    {
        /* @var $session VtCodeCamp\Session */
        foreach (Sessions::all() as $session) {
            $this->sessionRepository->post($session);
        }
        $vtCodeCamp2011Event = new Event('Vermont Code Camp 2011');
        $roomOneSpace = new Space('Room 1');
        $roomTwoSpace = new Space('Room 2');
        $roomThreeSpace = new Space('Room 3');
        $roomFourSpace = new Space('Room 4');
        $speakerRoomSpace = new Space('Speaker Room');
        $sessions = $this->sessionRepository->indexByEventAndSpace($vtCodeCamp2011Event);
        $this->assertCount(5, $sessions);
        $this->assertCount(6, $sessions[$roomOneSpace->getName()]);
        $this->assertCount(6, $sessions[$roomTwoSpace->getName()]);
        $this->assertCount(6, $sessions[$roomThreeSpace->getName()]);
        $this->assertCount(6, $sessions[$roomFourSpace->getName()]);
        $this->assertCount(2, $sessions[$speakerRoomSpace->getName()]);
    }

    public function testIndexByEventAndSpeaker()
    {
        /* @var $session VtCodeCamp\Session */
        foreach (Sessions::all() as $session) {
            $this->sessionRepository->post($session);
        }
        $vtCodeCamp2011Event = new Event('Vermont Code Camp 2011');
        $speakers = $this->sessionRepository->indexByEventAndSpeaker($vtCodeCamp2011Event);
        $this->assertCount(22, $speakers);
    }

    public function testIndexByEventAndTimePeriod()
    {
        /* @var $session VtCodeCamp\Session */
        foreach (Sessions::all() as $session) {
            $this->sessionRepository->post($session);
        }
        $vtCodeCamp2011Event = new Event('Vermont Code Camp 2011');
        $registrationTimePeriod = new TimePeriod(
            new DateTime('2011-09-10 08:00:00.000 EDT'),
            new DateTime('2011-09-10 08:45:00.000 EDT')
        );
        $welcomeTimePeriod = new TimePeriod(
            new DateTime('2011-09-10 08:45:00.000 EDT'),
            new DateTime('2011-09-10 09:00:00.000 EDT')
        );
        $firstTimePeriod = new TimePeriod(
            new DateTime('2011-09-10 09:00:00.000 EDT'),
            new DateTime('2011-09-10 10:00:00.000 EDT')
        );
        $secondTimePeriod = new TimePeriod(
            new DateTime('2011-09-10 10:15:00.000 EDT'),
            new DateTime('2011-09-10 11:15:00.000 EDT')
        );
        $thirdTimePeriod = new TimePeriod(
            new DateTime('2011-09-10 11:30:00.000 EDT'),
            new DateTime('2011-09-10 12:30:00.000 EDT')
        );
        $lunchTimePeriod = new TimePeriod(
            new DateTime('2011-09-10 12:30:00.000 EDT'),
            new DateTime('2011-09-10 13:30:00.000 EDT')
        );
        $fourthTimePeriod = new TimePeriod(
            new DateTime('2011-09-10 13:30:00.000 EDT'),
            new DateTime('2011-09-10 14:30:00.000 EDT')
        );
        $fifthTimePeriod = new TimePeriod(
            new DateTime('2011-09-10 14:45:00.000 EDT'),
            new DateTime('2011-09-10 15:45:00.000 EDT')
        );
        $snacksTimePeriod = new TimePeriod(
            new DateTime('2011-09-10 15:45:00.000 EDT'),
            new DateTime('2011-09-10 16:15:00.000 EDT')
        );
        $sixthTimePeriod = new TimePeriod(
            new DateTime('2011-09-10 16:15:00.000 EDT'),
            new DateTime('2011-09-10 17:15:00.000 EDT')
        );
        $raffleTimePeriod = new TimePeriod(
            new DateTime('2011-09-10 17:30:00.000 EDT')
        );
        $sessions = $this->sessionRepository->indexByEventAndTimePeriod($vtCodeCamp2011Event);
        $this->assertCount(11, $sessions);
        $this->assertCount(1, $sessions[$registrationTimePeriod->getStart()->format('c')]);
        $this->assertCount(1, $sessions[$welcomeTimePeriod->getStart()->format('c')]);
        $this->assertCount(4, $sessions[$firstTimePeriod->getStart()->format('c')]);
        $this->assertCount(4, $sessions[$secondTimePeriod->getStart()->format('c')]);
        $this->assertCount(5, $sessions[$thirdTimePeriod->getStart()->format('c')]);
        $this->assertCount(1, $sessions[$lunchTimePeriod->getStart()->format('c')]);
        $this->assertCount(5, $sessions[$fourthTimePeriod->getStart()->format('c')]);
        $this->assertCount(4, $sessions[$fifthTimePeriod->getStart()->format('c')]);
        $this->assertCount(1, $sessions[$snacksTimePeriod->getStart()->format('c')]);
        $this->assertCount(4, $sessions[$sixthTimePeriod->getStart()->format('c')]);
        $this->assertCount(1, $sessions[$raffleTimePeriod->getStart()->format('c')]);
    }
}
