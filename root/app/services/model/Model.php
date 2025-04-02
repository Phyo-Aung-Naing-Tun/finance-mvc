<?php

namespace Root\App\Services\Model;

use Root\App\Services\Model\BaseModel;

class Model extends BaseModel
{

    public static $model;

    public static function __callStatic($method, $arguments)
    {
        $callClass = get_called_class();
        self::$model = new $callClass();
        self::$model->validateMethod($method)->execute($method, $arguments);
    }
}
