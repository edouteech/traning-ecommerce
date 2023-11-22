<?php

use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\CategorieController;
use App\Http\Controllers\Api\SellController;
use App\Http\Controllers\Api\OrdersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Categorie;
use App\Models\Order_Products;

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

Route::get('/confirmation/{token}', [StudentController::class, 'confirmationMail']);

Route::post('login', [StudentController::class, 'login']);

Route::post('logout', [StudentController::class, 'logout']);

Route::post('update/password', [StudentController::class, 'checkMail']);

Route::post('update/{id/}password', [StudentController::class, 'updatepassword']);



//Fin des route des utilisateurs

//Début des routes pour les produits


Route::get('product', [ProductController::class, 'index']);

Route::post('product', [ProductController::class, 'store']);

Route::get('product/{id}', [ProductController::class, 'show']);

Route::get('product/{id}/edit', [ProductController::class, 'edit']);

Route::put('product/{id}/update', [ProductController::class, 'update']);

Route::delete('product/{id}/delete', [ProductController::class, 'destroy']);

Route::get('product/{categorie}/categorie', [ProductController::class, 'categorie']);

Route::get('prix/', [ProductController::class, 'prix']);




//Fin des routes pour les produits

//Début des routes pour les categories

Route::get('categorie', [CategorieController::class, 'index']);

Route::post('categorie', [CategorieController::class, 'store']);

Route::get('categorie/{id}', [CategorieController::class, 'show']);

Route::get('categorie/{id}/edit', [CategorieController::class, 'edit']);

Route::put('categorie/{categories}/update', [CategorieController::class, 'update']);

Route::delete('categorie/{categorie}/delete', [CategorieController::class, 'destroy']);

Route::get('categorie/{categorie}/categorie', [CategorieController::class, 'categorie']);

// Fin des routes pour la categorie

// Debut des routs pour les OrdersProducts

Route::post('sell/{orderId}/add', [SellController::class, 'addProductToOrder']);

Route::delete('sell/{orderId}/remove', [SellController::class, 'removeProductFromOrder']);

Route::get('sell/{orderId}', [SellController::class, 'getOrderProducts']);


// Route::get('order_products', [OrdersController::class, 'addProductToOrder']);
