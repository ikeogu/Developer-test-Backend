<?php

namespace App\Listeners;

use App\Events\AchievementUnlocked;
use App\Events\BadgeUnlocked;
use App\Models\Achievement;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use Illuminate\Support\Facades\DB;
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

        $a= Achievement::where('id','>=',$event->achievement_id)->first();

        $user = User::find($event->user_id);
       
        $db = DB::table('achievement_user')->
            where('user_id', $user->id)->
               where('achievement_id', $a->id)->exists();

        if(!$db){
            $user->achievements()->save($a);
            $user->save();
            event(new BadgeUnlocked($event->user_id,$event->achievement_id));
        }

    }
}
