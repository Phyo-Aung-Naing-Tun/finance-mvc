<?php

namespace Root\App\Services;

use Root\App\Services\Error\ErrorFactory;

class Route
{

    protected static $allowedMethods = ["get","post","delete","put","patch"];

    public static function __callStatic($name, $arguments)
    {
        if(in_array( strtolower($name), self::$allowedMethods)){
           dd([$name, $arguments]);
        }else{
            $errorMessage = $name . " " . "method is not allowed";
            ErrorFactory::createError(
               $class = Route::class,
               $view = "error",
               $message = $errorMessage,
               $status = 500
            );     
        }
   }


}