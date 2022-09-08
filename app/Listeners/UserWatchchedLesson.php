<?php

namespace App\Listeners;

use App\Events\AchievementUnlocked;
use App\Events\LessonWatched;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class UserWatchchedLesson
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(LessonWatched $event)
    {
        //
        $user_les = DB::table('lesson_user')->
            where('user_id',$event->user_id)->get();

        DB::table('lesson_user')->
        insert([
            'user_id' => $event->user_id,
            'lesson_id' => $event->lesson_id
        ]);

        if(!$user_les){
            event(new AchievementUnlocked($event->user_id,2));
        }
        if($user_les->count() > 5){
            event(new AchievementUnlocked($event->user_id,6));
        }
        return response()->json([
            'status' => 200,
            'message' => empty($user_les) ? 'First Lesson Watched' : 'Lesson Watched'
        ]);


    }
}
