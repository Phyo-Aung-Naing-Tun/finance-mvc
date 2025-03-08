<?php

namespace Root\App\Services\Route;

class Route extends RoutingEngine
{
   private static $routeEngine;

   public static function __callStatic($name, $arguments)
   {
      if (!self::$routeEngine) {
         self::$routeEngine = new self();
      }
      self::$routeEngine->registerRoutes($name, $arguments);
   }

   public static function getRoutes()
   {
      return self::$routeEngine->routes;
   }
}
