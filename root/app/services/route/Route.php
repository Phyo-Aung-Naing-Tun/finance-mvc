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

   public static function getRoutes() // get the registered routes
   {
      return self::$routeEngine->routes;
   }

   public static function getRequestRoute() // get the user request route to dispatch
   {
      $routeData = [];

      foreach (self::getRoutes() as $route) { //loop each register route

         $pattern = self::convertToRegex($route["url"]); //transform to regx route to check the route parameters

         if (preg_match($pattern, request()->url, $matches)) { //get the matches value

            array_shift($matches);
         }

         if (($route["url"] === request()->url || count($matches) > 0) && strtolower($route["method"]) === strtolower(request()->method)) {

            $routeData = $route;
            $routeData["params"] = array_values($matches);
         }
      }

      if (!count($routeData) > 0) { // if there is no matched route, error will be showed
         self::$routeEngine->error(
            $view = "error",
            $message = ["Route Not Found!"],
            $status = 404
         );
      }
      return $routeData;
   }

   public static function dispatch() // call the fun to do with current request route
   {

      $currentRoute = self::getRequestRoute();

      if (isset($currentRoute["controller"])) { //if there is controller call the method inside controller

         call_user_func_array([(new $currentRoute["controller"]()), $currentRoute["handler"]], $currentRoute["params"]);
      } else { // else call the second parameter function

         call_user_func_array($currentRoute["handler"], $currentRoute["params"]);
      }
   }

   private static function convertToRegex($path)
   {
      $pattern = preg_replace('/\{([^\/]+)\}/', '([^\/]+)', $path);  ///change user/{id} to	#^/user/([^\/]+)$#
      return '#^' . $pattern . '$#';
   }
}
