<?php

namespace Konsulting\DuskStandalone\Exceptions;

class CannotCreateDirectory extends \Exception
{
    public function __construct($message = '', $code = 0, \Throwable $previous = null)
    {
        parent::__construct("Cannot create directory '{$message}'", $code, $previous);
    }
}
