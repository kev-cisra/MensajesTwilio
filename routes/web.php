<?php

use App\Http\Controllers\MensajesController;
use App\Http\Controllers\PersonalController;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('Welcome'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});

Route::prefix("Mensajes")
->middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])
->group(function(){
    // Guarda la infoirmacion de mensaje
    Route::post("SaveMensa", [MensajesController::class, "SaveMensa"]);

    // Manda mensajes por twilio
    Route::post("SendMesa", [MensajesController::class, "SendMesaje"]);

    // Consulta mensajes proximos a enviarse
    Route::get("ConMensa", [MensajesController::class, "ConMensa"])->name("ConMensa");
});

Route::prefix("Personal")
->middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])
->group(function(){
    Route::get("/", [PersonalController::class, "index"])->name('Personal');

    // Consulta la informacion del personal
    Route::get("ConsPersonal", [PersonalController::class, "ConsPersonal"])->name("ConsPersonal");

    // guarda informacion del personal
    Route::post("SavePerso", [PersonalController::class, "SavePerso"])->name("SavePerso");

    // Eliminar Persopnal
    Route::delete("DeletPer/{id}", [PersonalController::class, "DeletPer"])->name("DeletPer");
});
