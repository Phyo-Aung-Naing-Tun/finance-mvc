<?php

namespace Root\App\Services\Database;



interface DBFactoryInterface
{
    public function connect($connection);
}
