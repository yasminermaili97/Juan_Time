<?php

namespace App\Exceptions;

use Exception;

class WatchNotFoundException extends Exception
{
    /**
     * Error code associated with the exception.
     *
     * @var int
     */
    protected $code;

    /**
     * Constructs a new WatchNotFoundException.
     *
     * @param string $message The exception message.
     * @param int    $code    The error code.
     */
    public function __construct($message, $code)
    {
        $this->code = $code;
        parent::__construct($message);
    }
}
