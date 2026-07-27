<?php

use Illuminate\Support\Facades\Route;
use App\Models\Page;
use App\Http\Controllers\HomeController;
Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('visitlog');

Route::post('/bot', [HomeController::class, 'bot'])->name('bot_post')->middleware('visitlog');
