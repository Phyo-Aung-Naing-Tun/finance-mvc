<?php

namespace Root\App\Services\Model;

use Root\App\Services\Database\DBFactory;
use Root\App\Services\MainService;
use Root\App\Services\SQL\QueryBuilder;

class BaseModel extends MainService
{

    const ALLOW_METHODS = ["create", "delete", "all", "first", "latest"];

    public $database;

    public $connection;

    public $table;

    public $fillables;

    public $queryBuilder;

    public function __construct()
    {
        if (!($this->database && $this->connection)) {
            $this->database =  (new DBFactory($this->connection))->build();
            $this->queryBuilder = new QueryBuilder($this->database, $this->table);
        }
    }

    protected function validateMethod($method)
    {
        if (!in_array($method, self::ALLOW_METHODS)) {
            return  $this->error(messages: ["( $method ) method is not allowed!"]);
        };

        return $this;
    }

    protected function execute($method, $arguements = null)
    {
        call_user_func_array([$this->queryBuilder, $method], $arguements);
    }
}
