<?php

namespace Diverently\IbanInfo\Exceptions;

use Exception;

class BicException extends Exception
{
    public function __construct($message, $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
