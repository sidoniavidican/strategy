<?php

use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\PlayerController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/players/index', [PlayerController::class, 'index']);
Route::get('/api/players/teams/{id}', [PlayerController::class, 'api']);
Route::patch('/players/switch/{playerA}/{playerB}', [PlayerController::class, 'switch']);
Route::get('/games/index', [GameController::class, 'index']);

Route::get('/currency/australian-dollars', [CurrencyController::class, 'getAustralianDollars']);