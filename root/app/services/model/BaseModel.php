<?php

namespace Root\App\Services\Model;

use Root\App\Services\Database\DBFactory;

class BaseModel
{

    public $database;

    public $connection;

    public $table;

    protected function __construct()
    {
        $this->database =  (new DBFactory($this->connection))->build();
    }
}
