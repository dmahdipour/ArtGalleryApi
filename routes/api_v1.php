<?php

use App\Http\Controllers\Api\V1\SettingController;
use App\Http\Controllers\Api\V1\MemberController;
use App\Http\Controllers\Api\V1\CommentController;
use App\Http\Controllers\Api\V1\ProjectController;
use App\Http\Controllers\Api\V1\TechniqueController;
use App\Http\Controllers\Api\V1\SubjectControlle;
use App\Http\Controllers\Api\V1\StyleController;
use App\Http\Controllers\Api\V1\SellController;
use Illuminate\Support\Facades\Route;


Route::get('/login', function () {
    return response()->json(['error' => 'توکن درست وارد نشده است.'], 400);
})->name('login');

Route::post('/setting', [SettingController::class, 'getSettings']);

Route::middleware('auth:sanctum')->get('/members', [MemberController::class, 'index']);
Route::middleware('auth:sanctum')->post('/member/info', [MemberController::class, 'info']);
Route::middleware('auth:sanctum')->post('/member/set_profile', [MemberController::class, 'setProfile']);

Route::middleware('auth:sanctum')->get('/comments', [CommentController::class, 'index']);
Route::middleware('auth:sanctum')->post('/comment/mark_as_read', [CommentController::class, 'markAsRead']);
Route::middleware('auth:sanctum')->post('/comment/unread_comment_count', [CommentController::class, 'unReadMessageCount']);
Route::middleware('auth:sanctum')->post('/comment/mark_as_confirmed', [CommentController::class, 'markAsConfirmed']);

Route::middleware('auth:sanctum')->get('/projects', [ProjectController::class, 'index']);
Route::middleware('auth:sanctum')->post('/project/info', [ProjectController::class, 'info']);

Route::middleware('auth:sanctum')->get('/techniques', [TechniqueController::class, 'index']);
Route::middleware('auth:sanctum')->post('/technique/info', [TechniqueController::class, 'info']);

Route::middleware('auth:sanctum')->get('/subjects', [SubjectControlle::class, 'index']);
Route::middleware('auth:sanctum')->post('/subject/info', [SubjectControlle::class, 'info']);

Route::middleware('auth:sanctum')->get('/styles', [StyleController::class, 'index']);
Route::middleware('auth:sanctum')->post('/style/info', [StyleController::class, 'info']);

Route::middleware('auth:sanctum')->post('/sell/info', [SellController::class, 'info']);
