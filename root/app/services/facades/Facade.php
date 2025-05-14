<?php

namespace Root\App\Services\Facades;

use Exception;

abstract class Facade
{

    /**
     * Handle dynamic, static calls to the object.
     *
     * @param  string  $method
     * @param  array  $aarguments
     * @return mixed
     */
    public static function __callStatic($method, $arguments)
    {
        $instance = static::getInstance();
        return (new $instance)->$method($arguments);
    }

    /**
     * get a call object
     * @return obj
     * @throws \Exception
     */

    public static function getInstance()
    {
        $instance = static::getFacadeAccessor();
        if (! $instance) {
            throw new Exception("A facade root has not been set.");
        }
        return $instance;
    }

    public static function  getFacadeAccessor()
    {
        throw new Exception('Facade does not implement getFacadeAccessor method.');
    }
}
