<?php

use Root\App\Services\Route\Route;

include __DIR__ . "/root/autoload.php";
include __DIR__ . "/root/helpers.php";
include __DIR__ . "/root/app/services/request/helper.php";
include __DIR__ . "/route/web.php";


Route::dispatch();
