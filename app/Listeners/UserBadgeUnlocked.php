<?php

namespace App\Listeners;

use App\Events\BadgeUnlocked;
use App\Models\Badge;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class UserBadgeUnlocked
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
    public function handle(BadgeUnlocked $event)
    {
        //
        $badge = Badge::where('id','>=',$event->badge_id)->first();
        $user = User::find($event->user_id);

        $db = DB::table('badge_user')->
        where('user_id', $user->id)->
        where('badge_id', $badge->id)->exists();

        if(!$db){
            $user->badges()->save($badge);
            $user->save();
        }
        return response()->json([
            'status' => 200,
            'message' => $db == false ? $badge->title . ' earned!' : 'Badge earned already!'
        ]);
    }
}
