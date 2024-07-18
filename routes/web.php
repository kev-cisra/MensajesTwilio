<?php

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

Route::prefix("SendMesa")
->middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])
->group(function(){
    Route::post("/", function(Request $request){
        $phone = $request->claPais.$request->telefono;
        // return $phone;
        return mensa_twilio($phone, $request->mensaje);
    });
});

Route::prefix("Personal")
->middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])
->group(function(){
    Route::get("/", [PersonalController::class, "index"])->name('Personal');

    Route::post("SavePerso", [PersonalController::class, "SavePerso"])->name("SavePerso");
});
