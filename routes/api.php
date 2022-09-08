<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AchievementsController;
use App\Http\Controllers\BadgeController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\UserController;

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


Route::group(['prefix' => 'user'], function () {
    Route::controller(UserController::class)->group(function () {
        Route::get('alluser', 'index');
        Route::post('add-user' . 'store');
        Route::get('getUser/{id}', 'show');
        Route::put('updateUser/{id}', 'update');
        Route::delete('delete-user/{id}', 'destroy');
    });
});

Route::group(['prefix' => 'badge'], function () {
    Route::controller(BadgeController::class)->group(function () {
        Route::get('allbagdes', 'index');
        Route::post('add-badge' . 'store');
        Route::get('getbadge/{id}', 'show');
        Route::put('updateBadge/{id}', 'update');
        Route::delete('delete-badge/{id}', 'destroy');
    });
});

Route::group(['prefix' => 'achievement'], function () {
    Route::controller(AchievementsController::class)->group(function () {
        Route::get('/users/{user}/achievements', 'index');
        Route::post('add-achievement' . 'store');
        Route::get('getAchievement/{id}', 'show');
        Route::put('updateAchievement/{id}', 'update');
        Route::delete('delete-achievement/{id}', 'destroy');
        Route::post('lesson_watched',  'watch_a_lesson');
        Route::post('comment_on_a_lesson', 'make_comment');
    });
});

Route::group(['prefix' => 'lesson'], function () {
    Route::controller(LessonController::class)->group(function () {
        Route::get('alllesson', 'index');
        Route::post('add-lesson' . 'store');
        Route::get('getLesson/{id}', 'show');
        Route::put('updateLesson/{id}', 'update');
        Route::delete('delete-less/{id}', 'destroy');
    });
});
