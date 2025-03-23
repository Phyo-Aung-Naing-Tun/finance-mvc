<?php

namespace Root\App\Services\Database;

use Root\App\Services\MainService;

class DBFactory extends MainService implements DBFactoryInterface
{

    public  function connect($connection)
    {


        $dbConnection = $connection ? $connection : env("DATABASE_CONNECTION");

        if (!isset($dbConnection)) {
            $this->error(messages: ["Couldn't find connection name", "Add your database conntection name in env file", "eg;DATABASE_CONNECTION=your_connection"]);
        }

        if (!key_exists($dbConnection, config("database"))) {
            $this->error(messages: ["Couldn't find connection name {$dbConnection} in database config!"]);
        }
    }
}
