<?php

namespace Root\App\Services\Route;

trait RouteTrait
{
    private static  $allowedMethods = ["get", "post", "delete", "put", "patch"];

    protected  function validate($method, $arguement)
    {
        $this->validateMethod($method);
    }

    protected  function validateMethod($method)
    {
        if (!in_array(strtolower($method), self::$allowedMethods)) {
            $errorMessage = $method . " " . "method is not allowed";
            $this->error(
                $view = "error",
                $message = $errorMessage,
                $status = 500
            );
        }
    }
}
