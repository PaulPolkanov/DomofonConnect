<?php

use App\Http\Controllers\miniAppTelegramController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TelegramBotController;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Request;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [miniAppTelegramController::class, 'index']);
Route::get('/open_domofon', [miniAppTelegramController::class, 'open_domofon']);