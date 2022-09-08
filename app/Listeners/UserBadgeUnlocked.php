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
        $badge = Badge::find($event->badge_id);
        $user = User::find($event->user_id);

        $db = DB::table('user_badge')->
        where('user_id', $user->user_id)->
        where('badge_id', $badge->badge_id)->exists();

        if(!$db){
            $user->badge()->associate($badge);
            $user->save();
        }
        return response()->json([
            'status' => 200,
            'message' => $db == false ? $badge->title . ' earned!' : 'Badge earned already!'
        ]);
    }
}
