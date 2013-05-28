<?php

namespace VtCodeCamp\Admin\Commands;

use Cilex\Command\Command,
    Symfony\Component\Console\Input\InputInterface,
    Symfony\Component\Console\Output\OutputInterface,
    Silex\Application,
    Hal\Resource,
    Hal\Link;

class BuildEvents extends Command
{
    /**
     * @var \Silex\Application
     */
    private $silexApp;

    public function __construct(Application $silexApp)
    {
        parent::__construct();
        $this->silexApp = $silexApp;
    }

    protected function configure()
    {
        $this->setName('events:build');
        $this->setDescription('Build events');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->buildSchedule();
        $this->buildSessions();
        $this->buildSpeakers();
    }

    private function buildSchedule()
    {
        $eventsPath = APPLICATION_ROOT . '/data';
        $eventsIterator = new \DirectoryIterator($eventsPath);
        $dataConfig = include APPLICATION_ROOT . '/config/data.php';
        foreach ($eventsIterator as $eventFile) {
            if (!$eventFile->isDot() && $eventFile->isDir()) {
                $spacesArray = array();
                $timePeriodsArray = array();
                $scheduleArray = array();
                $eventPath = $eventFile->getPathname();
                $eventHref = '/' . $eventFile->getBasename() . '/';
                $schedule = new Resource($eventHref . '/schedule/', array(
                    'title' => 'Schedule',
                ));
                $eventJson = file_get_contents($eventPath . '/index.json');
                $eventArray = json_decode($eventJson, true);
                $eventLinks = $eventArray['_links'];
                unset($eventArray['_links']);
                $event = new Resource($eventHref, $eventArray);
                if (isset($eventLinks['registration'])) {
                    $registrationLink = new Link($eventLinks['registration']['href'], 'registration');
                    $event->setLink($registrationLink);
                }
                $schedule->setEmbedded('event', $event, 'true');
                $sessionsPath = $eventPath . '/sessions/';
                $sessionsIterator = new \DirectoryIterator($sessionsPath);
                foreach ($sessionsIterator as $sessionFile) {
                    if ('json' == $sessionFile->getExtension()) {
                        $sessionPath = $sessionFile->getPathname();
                        $sessionHref = $eventHref . 'sessions/' . substr($sessionFile->getBasename(), 0, -strlen('.json'));
                        $sessionJson = file_get_contents($sessionPath);
                        $sessionArray = json_decode($sessionJson, true);
                        $sessionLinkRels = $sessionArray['_links'];
                        unset($sessionArray['_links']);
                        $session = new Resource($sessionHref, $sessionArray);
                        $array = array();
                        $resource = array();
                        foreach ($sessionLinkRels as $sessionLinkRel => $sessionLinks) {
                            switch ($sessionLinkRel) {
                                case 'event':
                                    $link = new Link($sessionLinks['href'], $sessionLinkRel);
                                    $session->setLink($link, true);
                                    break;
                                case 'space':
                                    $href = $sessionLinks['href'];
                                    $path = $eventsPath . $href . '.json';
                                    $json = file_get_contents($path);
                                    $array[$sessionLinkRel] = json_decode($json, true);
                                    $spaceLinks = $array[$sessionLinkRel]['_links'];
                                    unset($array[$sessionLinkRel]['_links']);
                                    $resource[$sessionLinkRel] = new Resource($href, $array[$sessionLinkRel]);
                                    if (isset($spaceLinks['track'])) {
                                        $trackHref = $spaceLinks['track']['href'];
                                        $trackPath = $eventsPath . $trackHref . '.json';
                                        $trackJson = file_get_contents($trackPath);
                                        $trackArray = json_decode($trackJson, true);
                                        unset($trackArray['_links']);
                                        $trackResource = new Resource($spaceLinks['track']['href'], $trackArray);
                                        $resource[$sessionLinkRel]->setEmbedded('track', $trackResource, true);
                                    }
                                    $link = new Link($sessionLinks['href'], $sessionLinkRel);
                                    $session->setLink($link, true);
                                    break;
                                case 'track':
                                    $href = $sessionLinks['href'];
                                    $path = $eventsPath . $href . '.json';
                                    $json = file_get_contents($path);
                                    $array[$sessionLinkRel] = json_decode($json, true);
                                    unset($array[$sessionLinkRel]['_links']);
                                    $resource[$sessionLinkRel] = new Resource($href, $array[$sessionLinkRel]);
                                    $session->setEmbedded($sessionLinkRel, $resource[$sessionLinkRel], true);
                                    break;
                                case 'category':
                                    foreach ($sessionLinks as $sessionLink) {
                                        $href = $sessionLink['href'];
                                        $path = $eventsPath . $href . '.json';
                                        $json = file_get_contents($path);
                                        $categoryArray = json_decode($json, true);
                                        $array[$sessionLinkRel][$categoryArray['slug']] = $categoryArray;
                                        unset($array[$sessionLinkRel][$categoryArray['slug']]['_links']);
                                        $resource[$sessionLinkRel][$categoryArray['slug']] = new Resource($href, $array[$sessionLinkRel][$categoryArray['slug']]);
                                        $session->setEmbedded($sessionLinkRel, $resource[$sessionLinkRel][$categoryArray['slug']]);
                                    }
                                    break;
                                case 'timePeriod':
                                    $href = $sessionLinks['href'];
                                    $path = $eventsPath . $href . '.json';
                                    $json = file_get_contents($path);
                                    $array[$sessionLinkRel] = json_decode($json, true);
                                    unset($array[$sessionLinkRel]['_links']);
                                    $resource[$sessionLinkRel] = new Resource($href, $array[$sessionLinkRel]);
                                    $link = new Link($sessionLinks['href'], $sessionLinkRel);
                                    $session->setLink($link, true);
                                    break;
                                case 'speaker':
                                    foreach ($sessionLinks as $sessionLink) {
                                        $href = $sessionLink['href'];
                                        $path = $eventsPath . $href . '.json';
                                        $json = file_get_contents($path);
                                        $speakerArray = json_decode($json, true);
                                        $array[$sessionLinkRel][$speakerArray['slug']] = $speakerArray;
                                        $speakerLinks = $array[$sessionLinkRel][$speakerArray['slug']]['_links'];
                                        unset($array[$sessionLinkRel][$speakerArray['slug']]['_links']);
                                        $resource[$sessionLinkRel][$speakerArray['slug']] = new Resource($href, $array[$sessionLinkRel][$speakerArray['slug']]);
                                        if (isset($speakerLinks['twitter'])) {
                                            $twitterLink = new Link($speakerLinks['twitter']['href'], 'twitter', $speakerLinks['twitter']['title']);
                                            $resource[$sessionLinkRel][$speakerArray['slug']]->setLink($twitterLink);
                                        }
                                        $session->setEmbedded($sessionLinkRel, $resource[$sessionLinkRel][$speakerArray['slug']]);
                                    }
                                    break;
                                case 'resource':
                                    foreach ($sessionLinks as $idx => $sessionLink) {
                                        $link = new Link($sessionLink['href'], $sessionLinkRel, $sessionLink['title']);
                                        $session->setLink($link);
                                    }
                                    break;
                            }
                        }
                        $spaceKeys = array();
                        if (isset($array['space']['order'])) {
                            $spaceKeys[] = $array['space']['order'];
                        }
                        if (isset($array['space']['slug'])) {
                            $spaceKeys[] = $array['space']['slug'];
                        }
                        $spaceKey = implode('-', $spaceKeys);
                        if (isset($array['space']['slug']) && isset($array['timePeriod']['slug'])) {
                            $spacesArray[$spaceKey] = $resource['space'];
                            $sessionsBySpaceArray[$spaceKey][$array['timePeriod']['start']] = $session;
                        }
                        if (isset($array['timePeriod']['slug'])) {
                            $timePeriodsArray[$array['timePeriod']['slug']] = $resource['timePeriod'];
                            if (isset($array['space']['slug'])) {
                                $scheduleArray[$array['timePeriod']['slug']][$spaceKey] = $session;
                            } else {
                                $scheduleArray[$array['timePeriod']['slug']][] = $session;
                            }
                        }
                    }
                }
                $scheduleDataPath = $dataConfig['cache'] . $eventHref . 'schedule/index.json';
                if (!is_dir($dataConfig['cache'])) {
                    mkdir($dataConfig['cache']);
                }
                if (!is_dir($dataConfig['cache'] . $eventHref)) {
                    mkdir($dataConfig['cache'] . $eventHref);
                }
                if (!is_dir($dataConfig['cache'] . $eventHref . 'schedule')) {
                    mkdir($dataConfig['cache'] . $eventHref . 'schedule');
                }
                ksort($spacesArray);
                foreach ($spacesArray as $space) {
                    $schedule->setEmbedded('space', $space);
                }
                ksort($scheduleArray);
                foreach ($scheduleArray as $timePeriodSlug => $sessionsBySpace) {
                    $timePeriod = $timePeriodsArray[$timePeriodSlug];
                    $schedule->setEmbedded('timePeriod', $timePeriod);
                    ksort($sessionsBySpace);
                    foreach ($spacesArray as $spaceKey => $space) {
                        $space = clone $spacesArray[$spaceKey];
                        if (isset($sessionsBySpace[$spaceKey])) {
                            $session = $sessionsBySpace[$spaceKey];
                            $spaceArray = $space->toArray();
                            $sessionArray = $session->toArray();
                            if (isset($spaceArray['_embedded']['track']) && ($spaceArray['_embedded']['track']['slug'] !== $sessionArray['_embedded']['track']['slug'])) {
                                throw new \RuntimeException('The session\'s track (' . $sessionArray['_embedded']['track']['slug'] . ') must be the same as its space\'s track (' . $spaceArray['_embedded']['track']['slug'] . '), if defined.');
                            }
                            $timePeriod->setEmbedded('space', $space);
                            $space->setEmbedded('session', $session, true);
                        } else {
                            $timePeriod->setEmbedded('space', $space);
                        }
                    }
                    foreach ($sessionsBySpace as $spaceKey => $session) {
                        if (!is_string($spaceKey)) {
                            $timePeriod->setEmbedded('session', $session, true);
                        }
                    }
                }
                file_put_contents($scheduleDataPath, $schedule->__toJson() . PHP_EOL);
            }
        }
    }

    private function buildSessions()
    {
        $eventsPath = APPLICATION_ROOT . '/data';
        $eventsIterator = new \DirectoryIterator($eventsPath);
        $dataConfig = include APPLICATION_ROOT . '/config/data.php';
        foreach ($eventsIterator as $eventFile) {
            if (!$eventFile->isDot() && $eventFile->isDir()) {
                $sessionsBySpaceArray = array();
                $spacesArray = array();
                $eventPath = $eventFile->getPathname();
                $eventHref = '/' . $eventFile->getBasename() . '/';
                $eventLink = new Link($eventHref, 'event');
                $sessions = new Resource($eventHref . '/sessions/', array(
                    'title' => 'Sessions',
                ));
                $eventJson = file_get_contents($eventPath . '/index.json');
                $eventArray = json_decode($eventJson, true);
                $eventLinks = $eventArray['_links'];
                unset($eventArray['_links']);
                $event = new Resource($eventHref, $eventArray);
                if (isset($eventLinks['registration'])) {
                    $registrationLink = new Link($eventLinks['registration']['href'], 'registration');
                    $event->setLink($registrationLink);
                }
                $sessions->setEmbedded('event', $event, 'true');
                $sessionsPath = $eventPath . '/sessions/';
                $sessionsIterator = new \DirectoryIterator($sessionsPath);
                foreach ($sessionsIterator as $sessionFile) {
                    if ('json' == $sessionFile->getExtension()) {
                        $sessionPath = $sessionFile->getPathname();
                        $sessionHref = $eventHref . 'sessions/' . substr($sessionFile->getBasename(), 0, -strlen('.json'));
                        $sessionJson = file_get_contents($sessionPath);
                        $sessionArray = json_decode($sessionJson, true);
                        $sessionLinkRels = $sessionArray['_links'];
                        unset($sessionArray['_links']);
                        $session = new Resource($sessionHref, $sessionArray);
                        $array = array();
                        $resource = array();
                        foreach ($sessionLinkRels as $sessionLinkRel => $sessionLinks) {
                            switch ($sessionLinkRel) {
                                case 'event':
                                    $link = new Link($sessionLinks['href'], $sessionLinkRel);
                                    $session->setLink($link, true);
                                    break;
                                case 'space':
                                    $href = $sessionLinks['href'];
                                    $path = $eventsPath . $href . '.json';
                                    $json = file_get_contents($path);
                                    $array[$sessionLinkRel] = json_decode($json, true);
                                    $spaceLinks = $array[$sessionLinkRel]['_links'];
                                    unset($array[$sessionLinkRel]['_links']);
                                    $resource[$sessionLinkRel] = new Resource($href, $array[$sessionLinkRel]);
                                    if (isset($spaceLinks['track'])) {
                                        $trackHref = $spaceLinks['track']['href'];
                                        $trackPath = $eventsPath . $trackHref . '.json';
                                        $trackJson = file_get_contents($trackPath);
                                        $trackArray = json_decode($trackJson, true);
                                        unset($trackArray['_links']);
                                        $trackResource = new Resource($spaceLinks['track']['href'], $trackArray);
                                        $resource[$sessionLinkRel]->setEmbedded('track', $trackResource, true);
                                    }
                                    $link = new Link($sessionLinks['href'], $sessionLinkRel);
                                    $session->setLink($link, true);
                                    break;
                                case 'track':
                                    $href = $sessionLinks['href'];
                                    $path = $eventsPath . $href . '.json';
                                    $json = file_get_contents($path);
                                    $array[$sessionLinkRel] = json_decode($json, true);
                                    unset($array[$sessionLinkRel]['_links']);
                                    $resource[$sessionLinkRel] = new Resource($href, $array[$sessionLinkRel]);
                                    $session->setEmbedded($sessionLinkRel, $resource[$sessionLinkRel], true);
                                    break;
                                case 'category':
                                    foreach ($sessionLinks as $sessionLink) {
                                        $href = $sessionLink['href'];
                                        $path = $eventsPath . $href . '.json';
                                        $json = file_get_contents($path);
                                        $categoryArray = json_decode($json, true);
                                        $array[$sessionLinkRel][$categoryArray['slug']] = $categoryArray;
                                        unset($array[$sessionLinkRel][$categoryArray['slug']]['_links']);
                                        $resource[$sessionLinkRel][$categoryArray['slug']] = new Resource($href, $array[$sessionLinkRel][$categoryArray['slug']]);
                                        $session->setEmbedded($sessionLinkRel, $resource[$sessionLinkRel][$categoryArray['slug']]);
                                    }
                                    break;
                                case 'timePeriod':
                                    $href = $sessionLinks['href'];
                                    $path = $eventsPath . $href . '.json';
                                    $json = file_get_contents($path);
                                    $array[$sessionLinkRel] = json_decode($json, true);
                                    unset($array[$sessionLinkRel]['_links']);
                                    $resource[$sessionLinkRel] = new Resource($href, $array[$sessionLinkRel]);
                                    $session->setEmbedded($sessionLinkRel, $resource[$sessionLinkRel], true);
                                    break;
                                case 'level':
                                    $href = $sessionLinks['href'];
                                    $path = $eventsPath . $href . '.json';
                                    $json = file_get_contents($path);
                                    $array[$sessionLinkRel] = json_decode($json, true);
                                    unset($array[$sessionLinkRel]['_links']);
                                    $resource[$sessionLinkRel] = new Resource($href, $array[$sessionLinkRel]);
                                    $session->setEmbedded($sessionLinkRel, $resource[$sessionLinkRel], true);
                                    break;
                                case 'speaker':
                                    foreach ($sessionLinks as $sessionLink) {
                                        $href = $sessionLink['href'];
                                        $path = $eventsPath . $href . '.json';
                                        $json = file_get_contents($path);
                                        $speakerArray = json_decode($json, true);
                                        $array[$sessionLinkRel][$speakerArray['slug']] = $speakerArray;
                                        $speakerLinks = $array[$sessionLinkRel][$speakerArray['slug']]['_links'];
                                        unset($array[$sessionLinkRel][$speakerArray['slug']]['_links']);
                                        $resource[$sessionLinkRel][$speakerArray['slug']] = new Resource($href, $array[$sessionLinkRel][$speakerArray['slug']]);
                                        if (isset($speakerLinks['twitter'])) {
                                            $twitterLink = new Link($speakerLinks['twitter']['href'], 'twitter', $speakerLinks['twitter']['title']);
                                            $resource[$sessionLinkRel][$speakerArray['slug']]->setLink($twitterLink);
                                        }
                                        $session->setEmbedded($sessionLinkRel, $resource[$sessionLinkRel][$speakerArray['slug']]);
                                    }
                                    break;
                                case 'resource':
                                    foreach ($sessionLinks as $idx => $sessionLink) {
                                        $link = new Link($sessionLink['href'], $sessionLinkRel, $sessionLink['title']);
                                        $session->setLink($link);
                                    }
                                    break;
                            }
                        }
                        $spaceKeys = array();
                        if (isset($array['space']['order'])) {
                            $spaceKeys[] = $array['space']['order'];
                        }
                        if (isset($array['space']['slug'])) {
                            $spaceKeys[] = $array['space']['slug'];
                        }
                        $spaceKey = implode('-', $spaceKeys);
                        if (isset($array['space']['slug']) && isset($array['timePeriod']['slug'])) {
                            $spacesArray[$spaceKey] = $resource['space'];
                            $sessionsBySpaceArray[$spaceKey][$array['timePeriod']['start']] = $session;
                        }
                    }
                }
                $sessionsDataPath = $dataConfig['cache'] . $eventHref . 'sessions/index.json';
                if (!is_dir($dataConfig['cache'])) {
                    mkdir($dataConfig['cache']);
                }
                if (!is_dir($dataConfig['cache'] . $eventHref)) {
                    mkdir($dataConfig['cache'] . $eventHref);
                }
                if (!is_dir($dataConfig['cache'] . $eventHref . 'sessions')) {
                    mkdir($dataConfig['cache'] . $eventHref . 'sessions');
                }
                ksort($sessionsBySpaceArray);
                foreach ($sessionsBySpaceArray as $spaceKey => $sessionsByTimePeriodArray) {
                    $space = $spacesArray[$spaceKey];
                    $sessions->setEmbedded('space', $space);
                    ksort($sessionsByTimePeriodArray);
                    foreach ($sessionsByTimePeriodArray as $sessionResource) {
                        $spaceArray = $space->toArray();
                        $sessionArray = $sessionResource->toArray();
                        if (isset($spaceArray['_embedded']['track']) && ($spaceArray['_embedded']['track']['slug'] !== $sessionArray['_embedded']['track']['slug'])) {
                            throw new \RuntimeException('The session\'s track (' . $sessionArray['_embedded']['track']['slug'] . ') must be the same as its space\'s track (' . $spaceArray['_embedded']['track']['slug'] . '), if defined.');
                        }
                        $space->setEmbedded('session', $sessionResource);
                    }
                }
                file_put_contents($sessionsDataPath, $sessions->__toJson() . PHP_EOL);
            }
        }
    }

    private function buildSpeakers()
    {
        $eventsPath = APPLICATION_ROOT . '/data';
        $eventsIterator = new \DirectoryIterator($eventsPath);
        $dataConfig = include APPLICATION_ROOT . '/config/data.php';
        foreach ($eventsIterator as $eventFile) {
            if (!$eventFile->isDot() && $eventFile->isDir()) {
                $speakersArray = array();
                $eventPath = $eventFile->getPathname();
                $eventHref = '/' . $eventFile->getBasename() . '/';
                $eventLink = new Link($eventHref, 'event');
                $speakers = new Resource($eventHref . '/speakers/', array(
                    'title' => 'Speakers',
                ));
                $eventJson = file_get_contents($eventPath . '/index.json');
                $eventArray = json_decode($eventJson, true);
                $eventLinks = $eventArray['_links'];
                unset($eventArray['_links']);
                $event = new Resource($eventHref, $eventArray);
                if (isset($eventLinks['registration'])) {
                    $registrationLink = new Link($eventLinks['registration']['href'], 'registration');
                    $event->setLink($registrationLink);
                }
                $speakers->setEmbedded('event', $event, 'true');
                $sessionsPath = $eventPath . '/sessions/';
                $sessionsIterator = new \DirectoryIterator($sessionsPath);
                $array = array();
                $resource = array();
                foreach ($sessionsIterator as $sessionFile) {
                    if ('json' == $sessionFile->getExtension()) {
                        $sessionPath = $sessionFile->getPathname();
                        $sessionHref = $eventHref . 'sessions/' . substr($sessionFile->getBasename(), 0, -strlen('.json'));
                        $sessionJson = file_get_contents($sessionPath);
                        $sessionArray = json_decode($sessionJson, true);
                        $sessionLinkRels = $sessionArray['_links'];
                        unset($sessionArray['_links']);
                        $session = new Resource($sessionHref, $sessionArray);
                        foreach ($sessionLinkRels as $sessionLinkRel => $sessionLinks) {
                            switch ($sessionLinkRel) {
                                case 'event':
                                    $link = new Link($sessionLinks['href'], $sessionLinkRel);
                                    $session->setLink($link, true);
                                    break;
                                case 'space':
                                    $href = $sessionLinks['href'];
                                    $path = $eventsPath . $href . '.json';
                                    $json = file_get_contents($path);
                                    $array[$sessionLinkRel][$href] = json_decode($json, true);
                                    $spaceLinks = $array[$sessionLinkRel][$href]['_links'];
                                    unset($array[$sessionLinkRel][$href]['_links']);
                                    if (!isset($resource[$sessionLinkRel][$href])) {
                                        $resource[$sessionLinkRel][$href] = new Resource($href, $array[$sessionLinkRel][$href]);
                                    }
                                    if (isset($spaceLinks['track'])) {
                                        $trackHref = $spaceLinks['track']['href'];
                                        $trackPath = $eventsPath . $trackHref . '.json';
                                        $trackJson = file_get_contents($trackPath);
                                        $trackArray = json_decode($trackJson, true);
                                        unset($trackArray['_links']);
                                        $trackResource = new Resource($spaceLinks['track']['href'], $trackArray);
                                        $resource[$sessionLinkRel][$href]->setEmbedded('track', $trackResource, true);
                                    }
                                    $session->setEmbedded($sessionLinkRel, $resource[$sessionLinkRel][$href], true);
                                    break;
                                case 'track':
                                    $href = $sessionLinks['href'];
                                    $path = $eventsPath . $href . '.json';
                                    $json = file_get_contents($path);
                                    $array[$sessionLinkRel][$href] = json_decode($json, true);
                                    unset($array[$sessionLinkRel][$href]['_links']);
                                    if (!isset($resource[$sessionLinkRel][$href])) {
                                        $resource[$sessionLinkRel][$href] = new Resource($href, $array[$sessionLinkRel][$href]);
                                    }
                                    $session->setEmbedded($sessionLinkRel, $resource[$sessionLinkRel][$href], true);
                                    break;
                                case 'timePeriod':
                                    $href = $sessionLinks['href'];
                                    $path = $eventsPath . $href . '.json';
                                    $json = file_get_contents($path);
                                    $array[$sessionLinkRel][$href] = json_decode($json, true);
                                    unset($array[$sessionLinkRel][$href]['_links']);
                                    if (!isset($resource[$sessionLinkRel][$href])) {
                                        $resource[$sessionLinkRel][$href] = new Resource($href, $array[$sessionLinkRel][$href]);
                                    }
                                    $session->setEmbedded($sessionLinkRel, $resource[$sessionLinkRel][$href], true);
                                    break;
                                case 'speaker':
                                    foreach ($sessionLinks as $sessionLink) {
                                        $href = $sessionLink['href'];
                                        $path = $eventsPath . $href . '.json';
                                        $json = file_get_contents($path);
                                        $speakerArray = json_decode($json, true);
                                        $array[$sessionLinkRel][$speakerArray['slug']] = $speakerArray;
                                        $speakerLinks = $array[$sessionLinkRel][$speakerArray['slug']]['_links'];
                                        unset($array[$sessionLinkRel][$speakerArray['slug']]['_links']);
                                        if (!isset($resource[$sessionLinkRel]) || !isset($resource[$sessionLinkRel][$speakerArray['slug']])) {
                                            $resource[$sessionLinkRel][$speakerArray['slug']] = new Resource($href, $array[$sessionLinkRel][$speakerArray['slug']]);
                                            if (isset($speakerLinks['twitter'])) {
                                                $twitterLink = new Link($speakerLinks['twitter']['href'], 'twitter', $speakerLinks['twitter']['title']);
                                                $resource[$sessionLinkRel][$speakerArray['slug']]->setLink($twitterLink);
                                            }
                                        }
                                        $resource[$sessionLinkRel][$speakerArray['slug']]->setEmbedded('session', $session);
                                        $link = new Link($href, 'speaker');
                                        $session->setLink($link, true);
                                    }
                                    break;
                                case 'resource':
                                    foreach ($sessionLinks as $idx => $sessionLink) {
                                        $link = new Link($sessionLink['href'], $sessionLinkRel, $sessionLink['title']);
                                        $session->setLink($link);
                                    }
                                    break;
                            }
                        }
                        if (isset($array['speaker'])) {
                            foreach ($array['speaker'] as $speakerArray) {
                                $speakersArray[$speakerArray['lastName'] . ', ' . $speakerArray['firstName']] = $resource['speaker'][$speakerArray['slug']];
                            }
                        }
                    }
                }
                $speakersDataPath = $dataConfig['cache'] . $eventHref . 'speakers/index.json';
                if (!is_dir($dataConfig['cache'])) {
                    mkdir($dataConfig['cache']);
                }
                if (!is_dir($dataConfig['cache'] . $eventHref)) {
                    mkdir($dataConfig['cache'] . $eventHref);
                }
                if (!is_dir($dataConfig['cache'] . $eventHref . 'speakers')) {
                    mkdir($dataConfig['cache'] . $eventHref . 'speakers');
                }
                ksort($speakersArray);
                foreach ($speakersArray as $speakerName => $speaker) {
                    $speakers->setEmbedded('speaker', $speaker);
                }
                file_put_contents($speakersDataPath, $speakers->__toJson() . PHP_EOL);
            }
        }
    }
}
