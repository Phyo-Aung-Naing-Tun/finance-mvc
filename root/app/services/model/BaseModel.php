<?php

namespace Root\App\Services\Model;

use Root\App\Services\Database\DBGenerator;

class BaseModel extends DBGenerator
{
    public function __invoke()
    {
        dd("here");
    }

    public function test()
    {

        dump("here");
    }
}
