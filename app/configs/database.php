<?php

return [
    "mysql" => [
        "connection" => "mysql",
        "host" =>  env("DATABASE_HOST") ?? "localhost",
        "dbname" => env("DATABASE_NAME") ?? "dbname",
        "username" => env("DATABASE_USERNAME") ?? "root",
        "password" => env("DATABASE_PASSWORD") ?? "",
        "port" => env("DATABASE_PORT") ?? 101
    ],
    "pgsql" => [
        "connection" => "pgsql",
        "host" =>  env("DATABASE_HOST") ?? "localhost",
        "dbname" => env("DATABASE_NAME") ?? "dbname",
        "username" => env("DATABASE_USERNAME") ?? "root",
        "password" => env("DATABASE_PASSWORD") ?? "",
        "port" => env("DATABASE_PORT") ?? 101
    ],
    // you can extends more
];
