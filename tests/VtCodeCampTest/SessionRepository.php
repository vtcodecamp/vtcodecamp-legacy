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

    private function checkExists($id)
    {
        if (!isset($this->sessionData[$id])) {
            throw new NotFound();
        }
    }

    private function checkRev(Session $session)
    {
        if (!isset($this->sessionData[$session->getId()])) {
            return;
        }
        if ($session->getRev() !== $this->sessionData[$session->getId()]['_rev']) {
            throw new Conflict();
        }
    }

    private function incrementRev(Session $session)
    {
        $increment = 0;
        if (null !== $session->getRev()) {
            $revParts = explode('-', $session->getRev());
            $increment = $revParts[0];
        }
        $increment++;
        $session->setRev($increment . '-' . md5(json_encode($session->arraySerialize())));
    }

    /**
     * Get
     * 
     * @param string $id
     * @return VtCodeCamp\Session
     */
    public function get($id)
    {
        $this->checkExists($id);
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
        $this->incrementRev($session);
        $this->sessionData[$session->getId()] = $session->arraySerialize();
    }

    /**
     * Put
     * 
     * @param VtCodeCamp\Session $session
     */
    public function put(Session $session)
    {
        $this->checkRev($session);
        $this->incrementRev($session);
        $this->sessionData[$session->getId()] = $session->arraySerialize();
    }

    /**
     * Delete
     * 
     * @param VtCodeCamp\Session $session
     */
    public function delete(Session $session)
    {
        $this->checkExists($session->getId());
        $this->checkRev($session);
        unset($this->sessionData[$session->getId()]);
    }
}
