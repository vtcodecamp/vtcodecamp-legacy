<?php

namespace VtCodeCamp\Exception\ClientError;

use VtCodeCamp\Exception\ClientError;

/**
 * @category    VtCodeCamp
 * @package     VtCodeCamp_Exception
 * @subpackage  ClientError
 */
class NotFound extends ClientError
{
    public function __construct($message = 'Not Found', $code = 404, $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
