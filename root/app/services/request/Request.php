<?php

namespace Root\App\Services\Request;

class Request
{

    public $method;

    private function __construct()
    {
        $this->method = $_SERVER["REQUEST_METHOD"];
    }

    public static function initialize()
    {
        return new self();
    }
}
