<?php

namespace Root\App\Services\SQL;

use Root\App\Services\MainService;

class QueryBuilder extends MainService  implements QueryBuilderInterface
{

    private $database;
    private $table;

    public function __construct($database, $table)
    {
        $this->database = $database;
        $this->table = $table;
    }


    public function create($value)
    {
        dd($this->database);
    }
}
