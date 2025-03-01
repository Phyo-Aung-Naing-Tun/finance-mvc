<?php

namespace Root\App\Services\Error;

class ErrorFactory
{
    public static function createError($class = null, $view = "error" , $message = null, $status = 500)
    {
              Error::getInstance()
            ->setStatusCode($status)
            ->setMessages(["[$class] $message"])
            ->setView($view) // Uses error.php by default
            ->execute();
    }
}