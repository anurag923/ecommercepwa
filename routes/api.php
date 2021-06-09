<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CookController;
use App\Http\Controllers\CuisineController;
use App\Http\Controllers\ItemController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('cook/register',[CookController::class,'store']);
Route::get('cuisines',[CuisineController::class,'getall']);
Route::get('cuisine/{cuisineid}',[CuisineController::class,'singlecuisine']);
Route::get('cook/items/{cookid}',[CookController::class,'cookitems']);
Route::get('item/cooks/{itemid}',[ItemController::class,'itemcooks']);
Route::middleware('auth:cook-api')->group(function(){
    Route::post('cuisine',[CuisineController::class,'store']);
    Route::post('cook/item',[CookController::class,'add_item_to_cook']);
    Route::post('fooditem/{cuisine_id}',[CuisineController::class,'cuisine_item']);
    //Route::post('cook/cuisine',[CookController::class,'add_cuisine_to_cook']);
});

