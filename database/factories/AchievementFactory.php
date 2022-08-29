<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AchievementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'name' => 'Achivement_'. \Str::random(4)
        ];
    }
}