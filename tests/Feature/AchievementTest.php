<?php

namespace Tests\Feature;

use App\Models\Achievement;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase;

class AchievementTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_achievement_can_be_added(){
        $this->withoutExceptionHandling();
        $data = [
            'title' => 'Achievemnt 1',
            'description' => 'Least Achievment',
        ];
        $response = $this->postJson(route('create-achievement', $data));

        $this->assertCount(1, Achievement::all());
        $response->assertStatus(200);
    }

    /** @test */
    public function get_all_achievement()
    {
        $this->withoutExceptionHandling();
        $response = $this->get(route('achievements'));
        $response->assertStatus(200);
    }

    /** @test */
    public function get_an_achievement()
    {
       $achievement =Achievement::factory()->create()->first();

        $response = $this->get(route('get_achievement',$achievement->id));
        $response->assertStatus(200);
    }
    /** @test */
    /** @test */
    public function an_achievement_can_be_patched()
    {
        $this->withoutExceptionHandling();

       $a =Achievement::factory()->create()->first();

        $response = $this->patch('api/achievement/updateAchievement/' .$a->id, $this->data());

       $a =$a->fresh();

        $this->assertEquals('UpdatedAchievement 2',$a->title);
        $this->assertEquals('Reward Receieved',$a->description);
    }

    private function data()
    {
        return [
            'title' => 'UpdatedAchievement 2',
            'description' => 'Reward Receieved'
        ];
    }

    /** @test */
    public function an_achievement_can_be_removed()
    {
        $this->withoutExceptionHandling();
        $b =Achievement::factory()->create()->first();

        $response = $this->delete('api/achievement/delete-achievement/' . $b->id, $this->data());

        $this->assertCount(0,Achievement::all());
    }
}
