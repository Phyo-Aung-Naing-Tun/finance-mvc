<?php

namespace Root\App\Services\Facades;

use Root\App\Services\Facades\Facade;
use Root\App\Services\Route\Router;

class Route extends Facade
{
    /**
     * Get the Router class to call dynamically.
     *
     * @return class-string<Router>
     */
    public static function getFacadeAccessor()
    {
        return Router::class;
    }
}
