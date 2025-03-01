<?php

spl_autoload_register(function($class){
    $file =  str_replace('\\','/',$class);
    $extension = ".php";
    $filePath = $file . $extension;

    if(file_exists($filePath)){
        include($filePath); // include the classes
    }else{
        echo $filePath . "doesn't exist";
        die();
    }
});