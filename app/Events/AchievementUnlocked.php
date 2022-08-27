<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AchievementUnlocked
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $achievement_id;
    public $user_id;

    /**
     * Create a new event instance.
     *
     * @return void
     */

    public function __construct($achivement_id, $user_id)
    {
        $this->achievement_id = $achivement_id;
        $this->user_id = $user_id;
    }


}
