<?php

namespace Root\App\Services\Error;

trait HandleErrors
{
    public  function error($view = "error", $messages = [], $status = 500)
    {
        $class = get_called_class();
        Error::getInstance()
            ->setStatusCode($status)
            ->setMessages(["$class", ...$messages])
            ->setView($view) // Uses error.php by default
            ->execute();
    }
}
