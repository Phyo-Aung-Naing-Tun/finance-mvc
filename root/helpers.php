<?php

include __DIR__ . "/root/app/services/request/helper.php";




if (!function_exists("dd")) {
    function dd($data)
    {
        echo "<pre>";
        var_dump($data);
        echo "</pre>";
        die();
    }
}

if (!function_exists("dump")) {
    function dump($data)
    {
        echo "<pre>";
        var_dump($data);
        echo "</pre>";
    }
}

if (!function_exists("view")) {
    function view($fileName)
    {
        dd($fileName);
    }
}
