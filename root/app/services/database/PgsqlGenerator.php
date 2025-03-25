<?php

namespace Root\App\Services\Database;

use Root\App\Services\Database\DBGenerator;

class PgsqlGenerator extends DBGenerator
{

    const CONNECTION_NAME = "pgsql";

    public function __construct($connection)
    {
        parent::__construct($connection);
    }
}
