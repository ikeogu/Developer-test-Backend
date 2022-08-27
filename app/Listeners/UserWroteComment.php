<?php

namespace App\Listeners;

use App\Events\CommentWritten;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserWroteComment
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
    public function handle(CommentWritten $event)
    {
        //
        $user = DB::table('comments')->
            where('user_id',$event->user_id)->
            first();
        if(!empty($user)){
            DB::table('comments')->
            insert([
                'user_id' => $event->user_id,
                'body'=> $event->comment
            ]);

            return response()->json([
                'status' => 200,
                'message' => 'First Comment Written'
            ]);
        }

    }
}
