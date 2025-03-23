<?php

use App\HTTP\Controllers\Auth\ForgotPasswordController;
use App\HTTP\Controllers\Auth\LogInController;
use App\HTTP\Controllers\Auth\RegisterController;
use Root\App\Services\Route\Route;



Route::get("/user/{id}/name/{slug}", function ($id, $slug) {
    dump($slug);
    dump($id);
});

Route::get("/", function () {
    view("home");
});

Route::get("/register", [RegisterController::class, "index"]);

Route::get("/login", [LogInController::class, "index"]);
Route::post("/login", [LogInController::class, "login"]);

Route::get("/forgot_password", [ForgotPasswordController::class, "index"]);
Route::get("/reset_password", [ForgotPasswordController::class, "showResetPasswordPage"]);

Route::get("/test", [LogInController::class, "store"]);
