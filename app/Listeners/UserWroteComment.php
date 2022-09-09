<?php

namespace App\Listeners;

use App\Events\CommentWritten;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

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
        $user_comment = DB::table('comments')->
            where('user_id',$event->user_id->id)->
            get();

        return response()->json([
            'status' => 200,
            'message' => ($user_comment->count() == 1) ? 'First Comment Written': 'Comment Written'
        ]);


    }
}
