<?php

namespace App\Events;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class CommentWritten
{
    use Dispatchable, SerializesModels;

    public $comment;
    public $user_id;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Comment $comment, User $user_id)
    {
        $this->comment = $comment;
        $this->user_id = $user_id;
    }
}
