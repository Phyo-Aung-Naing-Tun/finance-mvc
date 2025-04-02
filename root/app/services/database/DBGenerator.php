<?php

namespace Root\App\Services\Database;

use PDO;
use PDOException;
use Root\App\Services\MainService;

abstract class DBGenerator  extends MainService
{
    public $host;  // Database host

    public $dbname;  // Database name

    public $username;  // Database username

    public $password;  // Database password

    public $port; // Database port

    public $type;  // Database type eg; mysql or pgsql


    public function __construct($connection)
    {
        $this->host = $connection["host"] ?? null;

        $this->dbname = $connection["dbname"] ?? null;

        $this->username = $connection["username"] ?? null;

        $this->password = $connection["password"] ?? null;

        $this->port = $connection["port"] ?? null;

        $this->type = $connection["connection"] ?? null;
    }

    public function connect()
    {
        try {
            // Create a new PDO connection
            $pdo = new PDO("mysql:host=$this->host;dbname=$this->dbname;charset=utf8", $this->username, $this->password);

            // Set PDO to throw exceptions on error
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $pdo;
            echo "Connected successfully";
        } catch (PDOException $e) {
            $this->error(messages: ["Connection Failed!", $e->getMessage()]);
        }
    }
}
