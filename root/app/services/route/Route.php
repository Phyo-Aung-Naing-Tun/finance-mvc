<?php

namespace Root\App\Services\Route;

use Root\App\Services\MainService;

class Route extends MainService
{
   use RouteTrait;

   private static $routes = [];


   public static function __callStatic($name, $arguments)
   {
      (new self())->registerRoutes($name, $arguments);
   }
}
