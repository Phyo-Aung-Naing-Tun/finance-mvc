<?php

namespace Root\App\Services\Route;

trait RouteTrait
{
    private  $allowedMethods = ["get", "post", "delete", "put", "patch"];

    protected  function validate($method, $arguement)
    {
        $this->validateMethod($method);
        $this->validateArguement($arguement);
    }

    protected  function validateMethod($method)
    {
        if (!in_array(strtolower($method), $this->allowedMethods)) {
            $errorMessage = $method . " " . "method is not allowed";
            $this->error(
                $view = "error",
                $message = $errorMessage,
                $status = 500
            );
        }
    }

    protected function validateArguement($arguement)
    {
        if (count($arguement) === 0) {
            $this->error(
                $view = "error",
                $message = [
                    "Create Route Error",
                    "Required Two Arguements",
                    "First for url and second for method or array with controller name and method name"
                ],
                $status = 500
            );
        }

        if (count($arguement) < 2 && count($arguement) > 0 && gettype($arguement[0]) === "string") {
            dd("here");
            $this->error(
                $view = "error",
                $message = [
                    "Create Route Error",
                    "Required Second Arguement",
                    "It must be method or array with controller name and method name",
                ],
                $status = 500
            );
        }

        if (count($arguement) < 2 && count($arguement) > 0 && (gettype($arguement[0])  === "object" || gettype($arguement[0])  === "array")) {
            $this->error(
                $view = "error",
                $message = [
                    "Create Route Error",
                    "Required First Arguement",
                    "It must be url string",
                ],
                $status = 500
            );
        }
    }
}
