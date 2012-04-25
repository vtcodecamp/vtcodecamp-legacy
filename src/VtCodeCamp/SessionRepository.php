<?php

namespace VtCodeCamp;

use VtCodeCamp\Session,
    VtCodeCamp\Exception\ClientError\NotFound,
    VtCodeCamp\Exception\ClientError\Conflict,
    Doctrine\CouchDB\CouchDBClient,
    Doctrine\CouchDB\View\Query,
    Doctrine\CouchDB\HTTP\HTTPException;

/**
 * @category    VtCodeCamp
 * @package     VtCodeCamp_SessionRepository
 */
class SessionRepository
{
    /**
     * @var Doctrine\CouchDB\CouchDBClient
     */
    private $couchDbClient;

    public function __construct(CouchDBClient $couchDbClient)
    {
        $this->couchDbClient = $couchDbClient;
    }

    /**
     * Index By Event And Space
     * 
     * @param VtCodeCamp\Event $event
     * @return array
     */
    public function indexByEventAndSpace(Event $event)
    {
        $viewQuery = new Query(
            $this->couchDbClient->getHttpClient(),
            $this->couchDbClient->getDatabase(),
            'schedule',
            'event_space'
        );
        $viewQuery->setStartKey(array($event->getName(), null, null));
        $viewQuery->setEndKey(array($event->getName(), new \stdClass(), new \stdClass()));
        $viewQuery->setReduce(false);
        $results = $viewQuery->execute();
        $sessions = array();
        foreach ($results as $row) {
            $sessions[$row['key'][1]][$row['key'][2]] = Session::arrayDeserialize($row['value']);
        }
        return $sessions;
    }

    /**
     * Index By Event And Speaker
     * 
     * @param VtCodeCamp\Event $event
     * @return array
     */
    public function indexByEventAndSpeaker(Event $event)
    {
        $viewQuery = new Query(
            $this->couchDbClient->getHttpClient(),
            $this->couchDbClient->getDatabase(),
            'schedule',
            'event_speaker'
        );
        $viewQuery->setStartKey(array($event->getName()));
        $viewQuery->setEndKey(array($event->getName(), new \stdClass(), new \stdClass(), new \stdClass()));
        $viewQuery->setReduce(false);
        $results = $viewQuery->execute();
        $speakers = array();
        foreach ($results as $row) {
            $speakers[$row['key'][3]] = Person::arrayDeserialize($row['value']);
        }
        return $speakers;
    }

    /**
     * Index By Event And Time Period
     * 
     * @param VtCodeCamp\Event $event
     * @return array
     */
    public function indexByEventAndTimePeriod(Event $event)
    {
        $viewQuery = new Query(
            $this->couchDbClient->getHttpClient(),
            $this->couchDbClient->getDatabase(),
            'schedule',
            'event_time'
        );
        $viewQuery->setStartKey(array($event->getName(), null, null));
        $viewQuery->setEndKey(array($event->getName(), new \stdClass(), new \stdClass()));
        $viewQuery->setReduce(false);
        $results = $viewQuery->execute();
        $sessions = array();
        foreach ($results as $row) {
            if (isset($row['key'][2])) {
                $sessions[$row['key'][1]][$row['key'][2]] = Session::arrayDeserialize($row['value']);
            } else {
                $sessions[$row['key'][1]][] = Session::arrayDeserialize($row['value']);
            }
        }
        return $sessions;
    }

    /**
     * Get
     * 
     * @param string $id
     * @return VtCodeCamp\Session
     */
    public function get($id)
    {
        $response = $this->couchDbClient->findDocument($id);
        switch ($response->status) {
            case 200:
                return Session::arrayDeserialize($response->body);
            case 404;
                throw new NotFound();
        }
    }

    /**
     * Post
     * 
     * @param VtCodeCamp\Session $session
     */
    public function post(Session $session)
    {
        try {
            $response = $this->couchDbClient->postDocument($session->arraySerialize());
            $session->setId($response[0]);
            $session->setRev($response[1]);
        } catch (HTTPException $ex) {
            switch ($ex->getCode()) {
                case 409:
                    throw new Conflict();
                default:
                    throw $ex;
            }
        }
    }

    /**
     * Put
     * 
     * @param VtCodeCamp\Session $session
     */
    public function put(Session $session)
    {
        try {
            $response = $this->couchDbClient->putDocument($session->arraySerialize(), $session->getId());
            $session->setId($response[0]);
            $session->setRev($response[1]);
        } catch (HTTPException $ex) {
            switch ($ex->getCode()) {
                case 409:
                    throw new Conflict();
                default:
                    throw $ex;
            }
        }
    }

    /**
     * Delete
     * 
     * @param VtCodeCamp\Session $session
     */
    public function delete(Session $session)
    {
        try {
            $this->couchDbClient->deleteDocument($session->getId(), $session->getRev());
        } catch (HTTPException $ex) {
            switch ($ex->getCode()) {
                case 409:
                    throw new Conflict();
                default:
                    throw $ex;
            }
        }
    }
}
