<?php

use App\HTTP\Controllers\Auth\LogInController;
use Root\App\Services\Route\Route;

Route::pot("/login", [LogInController::class, "login"]);
