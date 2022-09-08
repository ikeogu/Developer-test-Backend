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
            where('user_id',$event->user_id)->
            exists();

        try {
            //code...
            $comment = $event->comment;
            $user = User::find($event->user_id);
            $user->comments()->associate($comment);
            $user->save();

        } catch (Exception $e) {
            //throw $th;
            dump('Error: fuelsales_summary_details write failed!');
            Log::error([
                "Mesg"   => $e->getMessage(),
                "File"  => $e->getFile(),
                "Line"  => $e->getLine()
            ]);
        }

        return response()->json([
            'status' => 200,
            'message' => empty($user_comment) ? 'First Comment Written': 'Comment Written'
        ]);


    }
}
