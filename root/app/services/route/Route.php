<?php

namespace Root\App\Services\Route;

use Root\App\Services\MainService;

class Route extends MainService
{
   use RouteTrait;

   private static $routes = [];


   public static function __callStatic($name, $arguments)
   {
      $instance = new self();

      $instance->validate($name, $arguments);
   }
}
