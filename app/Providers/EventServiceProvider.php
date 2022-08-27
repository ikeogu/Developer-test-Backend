<?php

namespace App\Providers;

use App\Events\AchievementUnlocked;
use App\Events\BadgeUnlocked;
use App\Events\LessonWatched;
use App\Events\CommentWritten;
use App\Listeners\UserAchiementUnlocked;
use App\Listeners\UserBadgeUnlocked;
use App\Listeners\UserWatchchedLesson;
use App\Listeners\UserWroteComment;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        CommentWritten::class => [
            //
            UserWroteComment::class
        ],
        LessonWatched::class => [
            //
            UserWatchchedLesson::class
        ],
        AchievementUnlocked::class =>[
            UserAchiementUnlocked::class
        ],
        BadgeUnlocked::class => [
            UserBadgeUnlocked::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
