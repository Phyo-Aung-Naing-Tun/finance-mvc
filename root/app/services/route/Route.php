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

   public static function getRequestRoute()
   {
      [$routeData] = array_values(array_filter(self::getRoutes(), function ($route) {
         return $route["url"] === request()->url && strtolower($route["method"]) === strtolower(request()->method);
      }));

      if (!isset($routeData)) {
         self::$routeEngine->error(
            $view = "error",
            $message = ["Route Not Found!"],
            $status = 404
         );
      }
      return $routeData;
   }

   public static function dispatch()
   {

      $currentRoute = self::getRequestRoute();
      if (isset($currentRoute["controller"])) {
         call_user_func([(new $currentRoute["controller"]()), $currentRoute["handler"]]);
      } else {
         call_user_func($currentRoute["handler"]);
      }
   }
}
