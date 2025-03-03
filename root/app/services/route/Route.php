<?php

namespace Root\App\Services\Route;

use Root\App\Services\Error\ErrorFactory;
use Root\App\Services\MainService;

class Route extends MainService
{
   
   private static $routes = [];

   private static $allowedMethods = ["get","post","delete","put","patch"];

   public static function __callStatic($name, $arguments)
   {
        if(in_array( strtolower($name), self::$allowedMethods)){

          $method = $name;
          $url = $arguments[0] ?? null;
          $method = $arguments[1] ?? null;
         

           dd([$name, $arguments]);
        }else{
            $errorMessage = $name . " " . "method is not allowed";
            self::error(
               $view = "error",
               $message = $errorMessage,
               $status = 500
            );          
        }
   }


}