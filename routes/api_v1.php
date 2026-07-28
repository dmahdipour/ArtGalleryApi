<?php

use App\Http\Controllers\Api\V1\SettingController;
use App\Http\Controllers\Api\V1\MemberController;
use App\Http\Controllers\Api\V1\MemberTypeController;
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
Route::post('/member/signup', [MemberController::class, 'signUp']);
Route::post('/member/verify_email', [MemberController::class, 'verifyEmail']);
Route::post('/member/resend_verification_email', [MemberController::class, 'resend_verificationEmail']);
Route::post('/member/forget_password', [MemberController::class, 'forgetPassword']);
Route::post('/member/login', [MemberController::class, 'login']);
Route::middleware('auth:sanctum')->post('/member/change_password', [MemberController::class, 'changePassword']);
Route::middleware('auth:sanctum')->put('/member/set_profile', [MemberController::class, 'setProfile']);
Route::middleware('auth:sanctum')->put('/member/deactive_user', [MemberController::class, 'deactiveUser']);

Route::middleware('auth:sanctum')->get('/member_types', [MemberTypeController::class, 'index']);
Route::middleware('auth:sanctum')->post('/member_type', [MemberTypeController::class, 'add']);
Route::middleware('auth:sanctum')->put('/member_type', [MemberTypeController::class, 'update']);
Route::middleware('auth:sanctum')->delete('/member_type', [MemberTypeController::class, 'delete']);
Route::middleware('auth:sanctum')->post('/member_types/info', [MemberTypeController::class, 'info']);

Route::middleware('auth:sanctum')->get('/comments', [CommentController::class, 'index']);
Route::middleware('auth:sanctum')->post('/comment', [CommentController::class, 'add']);
Route::middleware('auth:sanctum')->put('/comment', [CommentController::class, 'update']);
Route::middleware('auth:sanctum')->delete('/comment', [CommentController::class, 'delete']);
Route::middleware('auth:sanctum')->post('/comment/mark_as_read', [CommentController::class, 'markAsRead']);
Route::middleware('auth:sanctum')->post('/comment/unread_comment_count', [CommentController::class, 'unReadMessageCount']);
Route::middleware('auth:sanctum')->post('/comment/mark_as_published', [CommentController::class, 'markAsPublished']);

Route::middleware('auth:sanctum')->get('/projects', [ProjectController::class, 'index']);
Route::middleware('auth:sanctum')->post('/project', [ProjectController::class, 'add']);
Route::middleware('auth:sanctum')->put('/project', [ProjectController::class, 'update']);
Route::middleware('auth:sanctum')->delete('/project', [ProjectController::class, 'delete']);
Route::middleware('auth:sanctum')->post('/project/info', [ProjectController::class, 'info']);

Route::middleware('auth:sanctum')->get('/techniques', [TechniqueController::class, 'index']);
Route::middleware('auth:sanctum')->post('/technique', [TechniqueController::class, 'add']);
Route::middleware('auth:sanctum')->put('/technique', [TechniqueController::class, 'update']);
Route::middleware('auth:sanctum')->delete('/technique', [TechniqueController::class, 'delete']);
Route::middleware('auth:sanctum')->post('/technique/info', [TechniqueController::class, 'info']);

Route::middleware('auth:sanctum')->get('/subjects', [SubjectControlle::class, 'index']);
Route::middleware('auth:sanctum')->post('/subject', [SubjectControlle::class, 'add']);
Route::middleware('auth:sanctum')->put('/subject', [SubjectControlle::class, 'update']);
Route::middleware('auth:sanctum')->delete('/subject', [SubjectControlle::class, 'delete']);
Route::middleware('auth:sanctum')->post('/subject/info', [SubjectControlle::class, 'info']);

Route::middleware('auth:sanctum')->get('/styles', [StyleController::class, 'index']);
Route::middleware('auth:sanctum')->post('/style', [StyleController::class, 'add']);
Route::middleware('auth:sanctum')->put('/style', [StyleController::class, 'update']);
Route::middleware('auth:sanctum')->delete('/style', [StyleController::class, 'delete']);
Route::middleware('auth:sanctum')->post('/style/info', [StyleController::class, 'info']);

Route::middleware('auth:sanctum')->post('/sell', [SellController::class, 'add']);
Route::middleware('auth:sanctum')->put('/sell', [SellController::class, 'update']);
Route::middleware('auth:sanctum')->delete('/sell', [SellController::class, 'delete']);
Route::middleware('auth:sanctum')->post('/sell/info', [SellController::class, 'info']);
