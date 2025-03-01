<?php

use App\HTTP\Controllers\Auth\LogInController;
use Root\App\Services\Route ;

Route::pos("/login",[LogInController::class, "login"]);
