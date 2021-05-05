<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\RecipeController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [IndexController::class, 'index']);
Route::get('/details/{recipe}', [RecipeController::class, 'show']);
Route::middleware(['auth:sanctum', 'verified'])->group(function(){
    Route::get('/dashboard', [RecipeController::class, 'index'])->name('dashboard');
    
    Route::get('/recipe', [RecipeController::class, 'create']);
    Route::post('/recipe', [RecipeController::class, 'store']);
    
    Route::get('/recipe/{recipe}', [RecipeController::class, 'edit']);
    Route::put('/update/{recipe}', [RecipeController::class, 'update']);
Route::delete('/recipe/{recipe}', [RecipeController::class, 'destroy']);
});
    
    