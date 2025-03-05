<?php

namespace Root\App\Services\Route;

trait RouteTrait
{
    private  $allowedMethods = ["get", "post", "delete", "put", "patch"];

    protected  function registerRoutes($method, $arguement)
    {
        $this->validate($method, $arguement);
    }

    private function validate($method, $arguement)
    {
        $this->validateMethod($method);
        $this->validateArguement($arguement);
        $this->validateUrl($arguement[0]);
        $this->validateHandler($arguement[1]);
    }

    private  function validateMethod($method)
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

    private function validateArguement($arguement)
    {
        $count = count($arguement);
        if ($count === 0) {
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

        if ($count < 2 && $count > 0 && is_string($arguement[0])) {
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

        if ($count < 2 && $count > 0 && (is_object($arguement[0]) || is_array($arguement[0]))) {
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

    private function validateUrl($url)
    {
        if (!is_string($url)) {
            $this->error(
                $view = "error",
                $message = [
                    "Create Route Error",
                    "Url must be string",
                ],
                $status = 500
            );
        }
    }

    private function validateHandler($method)
    {
        if (is_object($method) || is_array($method)) {
            if (is_object($method)) {
                if (!is_callable($method)) {
                    $this->error(
                        $view = "error",
                        $message = [
                            "Create Route Error",
                            "Second arguement" . " " . $method . " " . " is not callable function!",
                        ],
                        $status = 500
                    );
                }
            }

            if (is_array($method)) {
                dd(gettype($method[0]));
            }
        } else {
            $this->error(
                $view = "error",
                $message = [
                    "Create Route Error",
                    "Second arguement is invalid",
                    "It must be method or array with controller name and method name",
                ],
                $status = 500
            );
        }
    }
}
