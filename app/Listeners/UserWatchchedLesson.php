<?php

namespace App\Listeners;

use App\Events\LessonWatched;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

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
            where('user_id',$event->user_id)->exists();

        DB::table('lesson_user')->
        insert([
            'user_id' => $event->user_id,
            'lesson_id' => $event->lesson_id
        ]);

        return response()->json([
            'status' => 200,
            'message' => $user_les == false ? 'First Lesson Watched' : 'Lesson Watched'
        ]);


    }
}
