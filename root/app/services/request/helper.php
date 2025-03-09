<?php

use Root\App\Services\Request\Request;


if (!function_exists("request")) {
    function request()
    {
        return Request::initialize();
    }
}
