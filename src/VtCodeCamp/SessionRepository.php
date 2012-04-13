<?php

namespace VtCodeCamp;

use VtCodeCamp\Session;

/**
 * @category    VtCodeCamp
 * @package     VtCodeCamp_SessionRepository
 */
interface SessionRepository
{
    /**
     * Get
     * 
     * @param string $id
     * @return VtCodeCamp\Session
     */
    public function get($id);

    /**
     * Post
     * 
     * @param VtCodeCamp\Session $session
     */
    public function post(Session $session);

    /**
     * Put
     * 
     * @param VtCodeCamp\Session $session
     */
    public function put(Session $session);

    /**
     * Delete
     * 
     * @param VtCodeCamp\Session $session
     */
    public function delete(Session $session);
}
