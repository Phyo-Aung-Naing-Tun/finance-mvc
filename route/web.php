<?php

use App\HTTP\Controllers\Auth\LogInController;
use Root\App\Services\Route ;

Route::post("/login",[LogInController::class, "login"]);
