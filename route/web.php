<?php

use App\HTTP\Controllers\Auth\LogInController;
use Root\App\Services\Route\Route;



Route::get("/product/{id}", function () {
    dd("here");
});
Route::post("/login", [LogInController::class, "login"]);
Route::post("/login", [LogInController::class, "login"]);
