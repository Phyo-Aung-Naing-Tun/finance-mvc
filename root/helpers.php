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

if (!function_exists("config")) { //For getting data inside config folder eg; config("database.host");

    function config($path = null)
    {
        if ($path) {

            $pathArray = explode(".", $path);

            $fileName = array_shift($pathArray);

            $configPath =  __DIR__ . "/../app/configs/{$fileName}.php";

            if (!file_exists($configPath)) {
                return null;
            }

            $config = require $configPath;

            if (count($pathArray) <= 0) {
                return $config;
            }

            foreach ($pathArray as $key) {
                $config = $config[$key];
            }

            return $config;
        }

        return null;
    }
}

if (!function_exists("env")) { //For getting data from .env file eg; env("APP_NAME")

    function env($key = null)
    {
        $envFile = __DIR__ . "/../.env";

        if (file_exists($envFile)) {

            $envData = parse_ini_file($envFile);

            if (isset($key)) {
                if (isset($envData[$key])) {
                    return $envData[$key];
                } else {
                    return null;
                }
            } else {
                return $envData;
            }
        };

        return null;
    }
}

if (!function_exists("rawSql")) {

    function rawSql($path = null)
    {
        $sqlFile = __DIR__ . "/app/services/sql/sql.php";

        if (file_exists($sqlFile)) {

            $sqlData = require $sqlFile;

            if (isset($path)) {
                $path = explode(".", $path);

                foreach ($path as $key) {
                    $sqlData = $sqlData[$key] ?? null;
                }

                return $sqlData;
            } else {
                return $sqlData;
            }
        };

        return null;
    }
}
