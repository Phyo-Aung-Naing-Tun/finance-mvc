<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

use Root\App\Services\Route\Route;

// Load required files
include __DIR__ . "/autoload.php";
include __DIR__ . "/helpers.php";
include __DIR__ . "/app/services/request/helper.php";
include __DIR__ . "/../route/web.php"; // Adjusted path

// Dispatch routes
Route::dispatch();
