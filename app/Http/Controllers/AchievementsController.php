<?php

namespace App\Http\Controllers;

use App\Events\CommentWritten;
use App\Events\LessonWatched;
use App\Models\Achievement;
use App\Models\Badge;
use App\Models\Comment;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Http\Request;
use DB;
use Dotenv\Parser\Lexer;
use Illuminate\Validation\Rules\Exists;

class AchievementsController extends Controller
{
    public function index(User $user)
    {


       $user_acheivements = $user->achievements;
        $next_available_achievements = Achievement::
            whereNotIn('id', $user_acheivements->pluck('id')->toArray())->
            get();
        if(!empty($user_acheivements)){
            $current_badge = $user->badges()->latest()->first();
            $id = !empty($current_badge) ? $current_badge->id : 0;
            $next_badges = Badge::where('id', '>', $id)->first();
            $remaing_to_unlock_next_badge = Badge::where('id', '<>', $id)->get();

            return response()->json([
                'unlocked_achievements' => $user_acheivements->pluck('name'),
                'next_available_achievements' => $next_available_achievements->pluck('name'),
                'current_badge' => $current_badge->title ?? '',
                'next_badge' => $next_badges->title,
                'remaing_to_unlock_next_badge' => $remaing_to_unlock_next_badge->count()
            ]);
        }

    }

    /* This was mentioned not to be part of the assigment. it should be assumed, but these are other events and listner triggers, they serve as the parents to trigger other event, that was why I had to write them */

    public function watch_a_lesson(Request $request){
        $request->validate([
            'user_id'=>[
            'integer'
            ],
            'lesson_id'=>[
                'integer'
            ]

        ]);
        $user = User::find($request->user_id);
        $lesson = Lesson::find($request->lesson_id);

        event(new LessonWatched($lesson,$user));

    }

    public function make_comment(Request $request){
        $request->validate([
            'user_id'=>[
                'required',
                'integer'
            ],
            'body'=>[
                'required',
                'string'
            ]
        ]);

        $comment = new Comment();
        $comment->user_id = $request->user_id;
        $comment->body = $request->body;
        $comment->save();

        event(new CommentWritten($comment, $comment->user_id));

    }
}
