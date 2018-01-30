<?php

namespace Konsulting\DuskStandalone\Exceptions;

class NotADirectory extends \Exception
{
    public function __construct($message = '', $code = 0, \Throwable $previous = null)
    {
        parent::__construct("'{$message}' is not a directory", $code, $previous);
    }
}
