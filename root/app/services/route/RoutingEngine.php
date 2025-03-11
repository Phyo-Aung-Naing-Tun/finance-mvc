<?php

namespace Root\App\Services\Route;

use Root\App\Services\MainService;

abstract class RoutingEngine extends MainService
{
    protected $routes = [];
    private  $allowedMethods = ["get", "post", "delete", "put", "patch"];

    protected  function registerRoutes($method, $argument)
    {
        $this->validate($method, $argument);
        $this->createRoute($method, $argument);
        return $this;
    }

    private function createRoute($method, $argument)
    {
        $url = $argument[0];
        $controller = is_array($argument[1]) && count($argument[1]) === 2 ? $argument[1][0] : null;
        $handler = is_array($argument[1]) && count($argument[1]) === 2 ? $argument[1][1] : $argument[1];

        $route = [
            "method" => $method,
            "url" => $url,
            "controller" => $controller,
            "handler" =>  $handler,
        ];

        $this->finalValidate($route);

        array_push($this->routes, $route);
    }
    //fot duplicated route
    private function finalValidate($route)
    {
        $data = array_filter($this->routes, function ($data) use ($route) {
            return $data["method"] == $route["method"] && $data["url"] == $route["url"];
        });

        if (count($data)) {
            $this->error(
                $view = "error",
                $message = [
                    "Create Route Error!",
                    "Duplicated Route",
                    "This route" . " " .  $route["url"] . " " . "with" . " " . $route["method"] . " " . " has been declared"
                ],
                $status = 500
            );
        }
    }

    private function validate($method, $argument)
    {
        $this->validateMethod($method);
        $this->validateArgument($argument);
        $this->validateUrl($argument[0]);
        $this->validateHandler($argument[1]);
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

    private function validateArgument($argument)
    {
        $count = count($argument);
        if ($count === 0) {
            $this->error(
                $view = "error",
                $message = [
                    "Create Route Error",
                    "Required Two Arguments",
                    "First for url and second for method or array with controller name and method name"
                ],
                $status = 500
            );
        }

        if ($count < 2 && $count > 0 && is_string($argument[0])) {
            $this->error(
                $view = "error",
                $message = [
                    "Create Route Error",
                    "Required Second Argument",
                    "It must be method or array with controller name and method name",
                ],
                $status = 500
            );
        }

        if ($count < 2 && $count > 0 && (is_object($argument[0]) || is_array($argument[0]))) {
            $this->error(
                $view = "error",
                $message = [
                    "Create Route Error",
                    "Required First Argument",
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
                            "Second argument" . " " . $method . " " . " is not callable function!",
                        ],
                        $status = 500
                    );
                }
            }

            if (is_array($method)) {

                $controller = $method[0];

                $controllerMethod = $method[1];

                if (!class_exists($controller)) {
                    $this->error(
                        $view = "error",
                        $message = [
                            "Create Route Error",
                            "Controller doesn't exist" . " " . $controller,
                        ],
                        $status = 500
                    );
                };

                if (!method_exists($controller, $controllerMethod)) {
                    $this->error(
                        $view = "error",
                        $message = [
                            "Create Route Error",
                            "Can't find method ( $controllerMethod ) in controller ($controller)",
                        ],
                        $status = 500
                    );
                }
            }
        } else {
            $this->error(
                $view = "error",
                $message = [
                    "Create Route Error",
                    "Second argument is invalid",
                    "It must be method or array with controller name and method name",
                ],
                $status = 500
            );
        }
    }
}
