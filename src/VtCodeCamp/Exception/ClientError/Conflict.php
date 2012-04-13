<?php

namespace VtCodeCamp\Exception\ClientError;

use VtCodeCamp\Exception\ClientError;

/**
 * @category    VtCodeCamp
 * @package     VtCodeCamp_Exception
 * @subpackage  ClientError
 */
class Conflict extends ClientError
{
    public function __construct($message = 'Conflict', $code = 409, $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
