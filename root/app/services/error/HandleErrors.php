<?php

namespace Root\App\Services\Error;

trait HandleErrors
{
    public static function error( $view = "error" , $message = null, $status = 500)
    {
            $class = get_called_class();
            Error::getInstance()
            ->setStatusCode($status)
            ->setMessages(["[$class] $message"])
            ->setView($view) // Uses error.php by default
            ->execute();
    }
}