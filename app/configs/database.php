<?php

return [
    "mysql" => [
        "connection" => "mysql",
        "host" =>  env("DATABASE_HOST") ?? "localhost",
        "dbname" => env("DATABASE_NAME") ?? "dbname",
        "username" => env("DATABASE_USERNAME") ?? "root",
        "password" => env("DATABASE_PASSWORD") ?? "",
        "port" => env("DATABASE_PORT") ?? 3306
    ],
    "pgsql" => [
        "connection" => "pgsql",
        "host" =>  env("DATABASE_HOST") ?? "localhost",
        "dbname" => env("DATABASE_NAME") ?? "dbname",
        "username" => env("DATABASE_USERNAME") ?? "root",
        "password" => env("DATABASE_PASSWORD") ?? "",
        "port" => env("DATABASE_PORT") ?? 5432
    ],
    "mysql_two" => [
        "connection" => "mysql",
        "host" =>  env("FINANCE_DATABASE_HOST") ?? "localhost",
        "dbname" => env("FINANCE_DATABASE_NAME") ?? "dbname",
        "username" => env("FINANCE_DATABASE_USERNAME") ?? "root",
        "password" => env("FINANCE_DATABASE_PASSWORD") ?? "",
        "port" => env("FINANCE_DATABASE_PORT") ?? 5432
    ]
    // you can extends more
];
