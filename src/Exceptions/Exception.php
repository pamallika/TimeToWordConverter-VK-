<?php

namespace src\Exceptions;

abstract class Exception extends \Exception implements ExceptionInterface
{
    public function __construct($message)
    {
        $this->message = $message;
        @set_exception_handler([$this, 'exception_handler']);
    }

    public function exception_handler(): void
    {
        print "Ошибка: " . $this->getMessage() . "\n";
    }

}