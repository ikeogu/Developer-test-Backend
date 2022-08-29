<?php

namespace App\Listeners;

use App\Events\AchievementUnlocked;
use App\Events\BadgeUnlocked;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserAchiementUnlocked
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
    public function handle(AchievementUnlocked $event)
    {
        //
        $user_archive = DB::table('user_achiement')->
            where('user_id',$event->user_id)->
            where('achievement_id',$event->achievement_id)->
            exists();

        if(!$user_archive){
            DB::table('user_achiement')->
            insert([
                'user_id' => $event->user_id,
                'achievement_id' => $event->achievement_id
            ]);

            event(new BadgeUnlocked($event->user_id,$event->achievement_id));
        }

    }
}
