<?php

namespace Root\App\Services\Route;

class Route extends RoutingEngine
{

   private static $routes = [];


   public static function __callStatic($name, $arguments)
   {
      (new self())->registerRoutes($name, $arguments);
   }
}
