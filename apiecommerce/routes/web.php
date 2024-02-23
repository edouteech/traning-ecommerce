<?php

use Illuminate\Support\Facades\Route;
use app\Http\Controllers\TestController;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Exemple de route 
// On fait passer un parametre userName a notre route 
Route::get('route1/{userName}', [TestController::class, 'methode1']);

Route::get('/route2', [TestController::class, 'methode2']);
//On créé une route qui mene a la view login en executant la function
Route::get('/login', [TestController::class, 'login']);

//On va afficher un vue en partant du controller