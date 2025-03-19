<?php

namespace Root\App\Services\Model;

use Root\App\Services\Database\DBGenerator;

class BaseModel
{
    public $host;  // Database host

    public $dbname;  // Database name

    public $username;  // Database username

    public $password;  // Database password

    public $database;

    public $port;

    public $type;


    protected function __construct()
    {
        dd("here");
    }
}
