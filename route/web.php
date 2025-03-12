<?php

use App\HTTP\Controllers\Auth\LogInController;
use Root\App\Services\Route\Route;



Route::get("/user/{id}/name/{slug}", function ($id, $slug) {
    dump($slug);
    dump($id);
});

Route::get("/", function () {
    view("home");
});


Route::get("/login", [LogInController::class, "index"]);
Route::post("/login", [LogInController::class, "login"]);
