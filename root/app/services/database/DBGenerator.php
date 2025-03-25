<?php

namespace Root\App\Services\Database;

use PDO;
use PDOException;

abstract class DBGenerator
{
    public $host;  // Database host

    public $dbname;  // Database name

    public $username;  // Database username

    public $password;  // Database password

    public $database;

    public $port;

    public $type;

    public function __construct($connection)
    {
        dd("here");
    }

    public function connect()
    {
        try {
            // Create a new PDO connection
            $pdo = new PDO("mysql:host=$this->host;dbname=$this->dbname;charset=utf8", $this->username, $this->password);

            // Set PDO to throw exceptions on error
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $this->database = $pdo;
            echo "Connected successfully";
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }
}
