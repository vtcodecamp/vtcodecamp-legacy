<?php

namespace VtCodeCampTest;

use VtCodeCamp\Session,
    VtCodeCamp\Exception\ClientError\NotFound,
    VtCodeCamp\Exception\ClientError\Conflict;

/**
 * @category    VtCodeCampTest
 * @package     VtCodeCampTest_SessionRepository
 */
class SessionRepository implements \VtCodeCamp\SessionRepository
{
    /**
     * @var array
     */
    private $sessionData;

    /**
     * Get
     * 
     * @param string $id
     * @return VtCodeCamp\Session
     */
    public function get($id)
    {
        if (!isset($this->sessionData[$id])) {
            throw new NotFound();
        }
        return Session::arrayDeserialize($this->sessionData[$id]);
    }

    /**
     * Post
     * 
     * @param VtCodeCamp\Session $session
     */
    public function post(Session $session)
    {
        if (isset($this->sessionData[$session->getId()])) {
            throw new Conflict();
        }
        $this->sessionData[$session->getId()] = $session->arraySerialize();
    }

    /**
     * Put
     * 
     * @param VtCodeCamp\Session $session
     */
    public function put(Session $session)
    {
        $this->sessionData[$session->getId()] = $session->arraySerialize();
    }

    /**
     * Delete
     * 
     * @param VtCodeCamp\Session $session
     */
    public function delete(Session $session)
    {
        unset($this->sessionData[$session->getId()]);
    }
}
