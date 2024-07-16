<?php

use App\Http\Controllers\PersonalController;
use Illuminate\Support\Facades\Route;

Route::prefix("Personal")
->middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])
->group(function() {
    Route::get("/", [PersonalController::class, "index"]);
});
