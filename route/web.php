<?php

use App\HTTP\Controllers\Auth\LogInController;
use Root\App\Services\Route\Route;


Route::get(function () {
    return "hi";
});
// Route::get("/product/{id}", function () {
//     view("index.vue");
// });
Route::post([LogInController::class, "login"]);
