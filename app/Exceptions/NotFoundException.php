<?php

namespace App\Exceptions;

use Exception;

class NotFoundException extends Exception
{
    public function __construct($message = null, $code = 404)
    {
        parent::__construct($code);
        $this->message = $message;
    }

    public function message()
    {
        return $this->message;
    }
}
