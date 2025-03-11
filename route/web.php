<?php

use App\HTTP\Controllers\Auth\LogInController;
use Root\App\Services\Route\Route;



Route::get("/", function () {
    view("home");
});


Route::get("/login", [LogInController::class, "index"]);
Route::post("/login", [LogInController::class, "login"]);
