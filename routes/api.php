<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AchievementsController;
use App\Http\Controllers\BadgeController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
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


Route::group(['prefix' => 'user'], function () {

    Route::get('alluser', [UserController::class,'index'])->
        name('user.getAllUsers');
    Route::post('add-user', [UserController::class,'store'])->
        name('user.addUser');
    Route::get('getUser/{id}',[UserController::class, 'show'])->
        name('user.getUser');
    Route::patch('updateUser/{id}',[UserController::class, 'update'])->
        name('user.updateUser');
    Route::delete('delete-user/{id}',[UserController::class, 'destroy'])->
        name('user.deleteUser');

});

Route::group(['prefix' => 'badge'], function () {

    Route::get('allbagdes',[BadgeController::class, 'index'])->
        name('allBadges');
    Route::post('add-badge',[BadgeController::class, 'store'])->
        name('addBadge');
    Route::get('getbadge/{id}',[BadgeController::class, 'show'])->
        name('getBadge');
    Route::patch('updateBadge/{id}',[BadgeController::class,'update'])->
        name('updateBadge');
    Route::delete('delete-badge/{id}',[BadgeController::class, 'destroy'])->
        name('deleteBadge');

});

Route::group(['prefix' => 'achievement'], function () {

    Route::get('users/{user}/achievements',[AchievementsController::class, 'index2'])->
        name('achievement.user_achievement');
    Route::get('/achievements', [AchievementsController::class, 'index'])->
        name('achievements');
    Route::post('add-achievement' ,[AchievementsController::class,'store'])->
        name('create-achievement');
    Route::get('getAchievement/{id}',[AchievementsController::class, 'show'])->
        name('get_achievement');
    Route::patch('updateAchievement/{id}',[AchievementsController::class ,'update'])->
        name('updateAchievement');
    Route::delete('delete-achievement/{id}',[AchievementsController::class, 'destroy'])->
        name('remove_achievement');
    Route::post('lesson_watched', [AchievementsController::class,'watch_a_lesson'])->
        name('lesson_watched');

});

Route::group(['prefix' => 'lesson'], function () {

    Route::get('alllesson',[LessonController::class, 'index'])->
        name('allLessons');
    Route::post('add-lesson',[LessonController::class,'store'])->
        name('addLesson');
    Route::get('getLesson/{id}',[LessonController::class, 'show'])->
        name('getLesson') ;
    Route::patch('updateLesson/{id}',[LessonController::class, 'update'])->
        name('updateLesson');
    Route::delete('delete-less/{id}',[LessonController::class, 'destroy'])->
        name('deleteLesson');
    Route::post('watch_a_lesson', [LessonController::class, 'watch_a_lesson'])->
        name('watch_a_lesson');

});

Route::group(['prefix' => 'comment'], function () {

    Route::get('allcomments', [CommentController::class, 'index'])->
        name('allComments');
    Route::post('add-comment', [CommentController::class, 'store'])->
        name('addComment');
    Route::get('getComment/{id}', [CommentController::class, 'show'])->
        name('getComment');
    Route::patch('updateComment/{id}', [CommentController::class, 'update'])->
        name('updateComment');
    Route::delete('delete-comment/{id}', [CommentController::class, 'destroy'])->
        name('deleteComment');

});

