<?php

namespace Database\Seeders;

use App\Models\Achievement;
use App\Models\Badge;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $lessons = Lesson::factory()->
            count(20)->
            create();

        $users = User::factory()->
            count(10)->
            create();

        $badges = Badge::factory()->
            count(10)->
            sequence(fn ($sequence) => ['title' => $sequence->index . ' Badge Earned '])->
            create();

        $achievements = Achievement::factory()->
            count(12)->
            sequence(fn ($sequence) => ['title' => $sequence->index.' Lesson Watched Achievement ' ])->
            create();

    }
}
