<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('users')->name('users.')->group(function () {

    Route::get('/', [UserController::class, 'index'])->name('index');

    Route::get('/{user}', [UserController::class, 'detail'])->name('detail');

    Route::post('/', [UserController::class, 'create'])->name('create');

    Route::put('/{user}', [UserController::class, 'update'])->name('update-put');

    Route::patch('/{user}', [UserController::class, 'update'])->name('update-patch');

    Route::delete('/{user}', [UserController::class, 'delete'])->name('delete');
});
