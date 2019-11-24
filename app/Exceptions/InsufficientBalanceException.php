<?php

namespace App\Exceptions;

use Exception;

class InsufficientBalanceException extends Exception
{
    /*
    //We could override each custom exception with own code: $code = 1000
    //but for now it is enough just to have own class in the future we can add: $code without refactoring of service
    public function __construct($message = "", $code = 1000, Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }
    */
}
