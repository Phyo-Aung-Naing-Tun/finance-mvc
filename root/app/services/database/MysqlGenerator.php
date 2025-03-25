<?php

namespace Root\App\Services\Database;

use Root\App\Services\Database\DBGenerator;

class MysqlGenerator extends DBGenerator
{

    const CONNECTION_NAME = "mysql";

    public function __construct($connection)
    {
        parent::__construct($connection);
    }
}
