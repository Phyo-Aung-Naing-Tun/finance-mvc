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
    function view($fileName, $payload = [])
    {
        $transformKeys = [];
        $keys = array_keys($payload);

        foreach ($keys as $key) {
            $$key = $payload[$key];
            $transformKeys[$key] = &$$key;
        }
        $transformKeys = $payload;
        include "./resource/view/" . $fileName  . '.php';
    }
}

if (!function_exists(("component"))) {
    function component($fileName, $payload = [])
    {
        $transformKeys = [];
        $keys = array_keys($payload);

        foreach ($keys as $key) {
            $$key = $payload[$key];
            $transformKeys[$key] = &$$key;
        }
        $transformKeys = $payload;
        include "./resource/view/components/" . $fileName  . '.php';
    }
}
