<?php

use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\StudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Début des routes pour l'action des utilisateur


Route::get('users', [StudentController::class, 'index']);

Route::post('users', [StudentController::class, 'store']);

Route::get('users/{id}', [StudentController::class, 'show']);

Route::get('users/{id}/edit', [StudentController::class, 'edit']);

Route::put('users/{id}/edit', [StudentController::class, 'update']);

Route::delete('users/{id}/delete', [StudentController::class, 'destroy']);

Route::post('login', [StudentController::class, 'login']);

Route::post('logout', [StudentController::class, 'logout']);

//Fin des route des utilisateurs

//Début des routes pour les produits


Route::get('product', [ProductController::class, 'index']);

Route::post('product', [ProductController::class, 'store']);

Route::get('product/{id}', [ProductController::class, 'show']);

Route::get('product/{id}/edit', [ProductController::class, 'edit']);

Route::put('product/{id}/update', [ProductController::class, 'update']);

Route::delete('product/{id}/delete', [ProductController::class, 'destroy']);

Route::delete('product/{categorie}', [ProductController::class, 'categorie']);



//Fin des routes pour les produits

//Début des