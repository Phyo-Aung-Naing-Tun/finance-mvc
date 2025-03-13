<?php

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
        $home = "my";
        include "./resource/view/" . $fileName  . '.php';
    }
}

if (!function_exists("app_init")) {
    function app_init()
    {
        include __DIR__ . "/bootstrap.php";
    }
}
