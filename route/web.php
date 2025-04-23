<?php

use App\HTTP\Controllers\Auth\ForgotPasswordController;
use App\HTTP\Controllers\Auth\LogInController;
use App\HTTP\Controllers\Auth\RegisterController;
use Root\App\Services\Migration\Blueprint;
use Root\App\Services\Migration\Schema;
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

Route::get("/test", function () {
    $dir = __DIR__ . "/../database";
    $files = array_diff(scandir($dir), ['.', '..']);

    foreach (array_values($files) as $key => $file) {
        $filePath = $dir . "/" . $file;

        try {
            $migration = require $filePath;

            if (method_exists($migration, "up")) {
                $migration->up();
                echo "\033[32m[SUCCESS]\033[0m Migrated: {$file}" . PHP_EOL;
            } else {
                echo "\033[33m[SKIPPED]\033[0m No 'up' method: {$file}" . PHP_EOL;
            }
        } catch (Throwable $e) {
            echo "\033[31m[FAILED]\033[0m {$file}: " . $e->getMessage() . PHP_EOL;
        }
    }
});
