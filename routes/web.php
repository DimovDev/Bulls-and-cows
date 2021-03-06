<?php

use App\Http\Controllers\GameController;
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
    return view('game');
});

Route::get('/game', function () {
    return view('game');
});

Route::post('/new-game', [GameController::class, 'newGame']);

Route::post('/check/{guess}', [GameController::class, 'checkNumber']);

Route::get('/give-up', [GameController::class, 'giveUp']);

Route::get('/get-top/{category}', [GameController::class, 'getTop']);
