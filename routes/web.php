<?php

use Illuminate\Support\Facades\Route;
use App\Models\Page;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\MemberController;

Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('visitlog');

Route::get('/project/', [ProjectController::class, 'index'])->name('projectIndex')->middleware('visitlog');
Route::get('/project/tag/{tag}/{id}', [ProjectController::class, 'tag'])->name('projectTag')->middleware('visitlog');
Route::get('/project/qr/{uuid}', [ProjectController::class, 'qr'])->name('projectQr')->middleware('visitlog');
Route::get('/project/{uuid}', [ProjectController::class, 'info'])->name('projectInfo')->middleware('visitlog');

Route::get('/member/', [MemberController::class, 'index'])->name('memberIndex')->middleware('visitlog');

Route::post('/bot', [HomeController::class, 'bot'])->name('bot_post')->middleware('visitlog');
