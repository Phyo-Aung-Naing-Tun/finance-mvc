<?php

namespace Root\App\Services\Database;

use PDO;
use PDOException;
use Root\App\Services\Database\DBGenerator;

class PgsqlGenerator extends DBGenerator
{

    const CONNECTION_NAME = "pgsql";

    public function __construct($connection)
    {
        parent::__construct($connection);
    }

    public function connect()
    {
        try {
            // Create a new PDO connection for PostgreSQL
            $pdo = new PDO("pgsql:host=$this->host;dbname=$this->dbname", $this->username, $this->password);

            // Set PDO to throw exceptions on error
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            echo "Connected successfully"; // This will now be executed
            return $pdo;
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }
}
