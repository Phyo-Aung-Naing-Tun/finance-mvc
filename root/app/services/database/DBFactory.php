<?php

namespace Root\App\Services\Database;

use Root\App\Services\MainService;

class DBFactory extends MainService implements DBFactoryInterface
{

    public  function connect($connection)
    {


        $dbConnection = $connection ? $connection : env("DATABASE_CONNECTION");

        if (isset($dbConnection)) {
            $this->error(messages: ["Couldn't find connection name { $dbConnection }"]);
        }

        // dd($dbConnection);

        dd(key_exists($dbConnection, config("database")));

        key_exists($connection, $availableConnections);


        dd($availableConnections);

        dd($connection);
    }
}
