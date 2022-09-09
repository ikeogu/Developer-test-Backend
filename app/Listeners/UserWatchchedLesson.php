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
            where('user_id',$event->user->id)->get();

        if (!empty($user_les)) {
            event(new AchievementUnlocked($event->user->id, 2));
        } elseif ($user_les->count() > 5) {
            event(new AchievementUnlocked($event->user->id, 6));
        } else {
            event(new AchievementUnlocked($event->user->id, count($user_les) + 1));
        }
        return response()->json([
            'status' => 200,
            'message' => empty($user_les) ? 'First Lesson Watched' : 'Lesson Watched'
        ]);

    }
}
