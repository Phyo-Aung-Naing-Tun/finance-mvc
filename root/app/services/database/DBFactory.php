<?php

namespace Root\App\Services\Database;

use Root\App\Services\MainService;

class DBFactory extends MainService implements DBFactoryInterface
{

    private $connection;

    public function __construct($connection)
    {

        $connectionName = $connection ? $connection : env("DATABASE_CONNECTION");

        if (!isset($connectionName)) {
            $this->error(messages: ["Couldn't find connection name", "Add your database conntection name in env file", "eg;DATABASE_CONNECTION=your_connection"]);
        }

        if (!key_exists($connectionName, config("database"))) {
            $this->error(messages: ["Couldn't find connection name {$connectionName} in database config!"]);
        }

        $this->connection = config("database.$connectionName");
    }

    public  function build()
    {

        $connection = $this->connection["connection"] ?? null;

        if ($connection == MysqlGenerator::CONNECTION_NAME) {
            return (new MysqlGenerator($this->connection))->connect();
        } elseif ($connection == PgsqlGenerator::CONNECTION_NAME) {
            return (new PgsqlGenerator($this->connection))->connect();
        } else {
            $this->error(messages: ["Your database type {$connection} isn't supported yet!Plesae use mysql or pgsql"]);
            exit;
        }
    }
}
