<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AchievementsController;

Route::get('/users/{user}/achievements', [AchievementsController::class, 'index']);

Route::post('lesson_watched',[AchievementsController::class,'watch_a_lesson']);
Route::post('comment_on_a_lesson',[AchievementsController::class, 'make_comment']);
