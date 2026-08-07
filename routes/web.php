<?php

use Illuminate\Support\Facades\Route;
use App\Models\Page;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;

Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('visitlog');

Route::get('/project/', [ProjectController::class, 'index'])->name('projectIndex')->middleware('visitlog');
Route::get('/project/{uuid}', [ProjectController::class, 'info'])->name('projectInfo')->middleware('visitlog');

Route::post('/bot', [HomeController::class, 'bot'])->name('bot_post')->middleware('visitlog');
