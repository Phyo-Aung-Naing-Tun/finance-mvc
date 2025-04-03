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
            $this->table = $this->table ? $this->table : $this->createTableName();
            $this->queryBuilder = new QueryBuilder($this->database, $this->table, $this->fillables);
        }
    }

    protected  function createTableName()
    {
        $vowels = ["a", "e", "i", "o", "u"];
        $callClass = get_called_class();
        $callClass = explode('\\', $callClass);
        $callClass = end($callClass);
        $callClass = strtolower($callClass);
        $callClassArray = str_split($callClass);
        $lastTwoWords =  array_slice($callClassArray, -2);
        if (end($lastTwoWords) == "s" || end($lastTwoWords) == "x" || end($lastTwoWords) == "z") {
            return $callClass . "es";
        } elseif (end($lastTwoWords) == "y") {
            $firstWord = array_shift($lastTwoWords);
            $firstWordVowel = in_array($firstWord, $vowels);
            if (!$firstWordVowel) {
                array_pop($callClassArray); //cut the y  and add ies
                return join($callClassArray) . "ies";
            }
        } elseif (end($lastTwoWords) == "h") {
            $firstWord = array_shift($lastTwoWords);
            if ($firstWord == "c" || $firstWord == "s") {
                return $callClass . "es";
            }
        }
        return $callClass . "s";
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
        return call_user_func_array([$this->queryBuilder, $method], $arguements);
    }
}
