<?php

namespace Tests\Feature;

use App\Models\Badge;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BadgeTest extends TestCase
{
     use RefreshDatabase;
    /** @test */
    public function a_new_bagde_can_be_added(){

        $this->withoutExceptionHandling();
        $data = [
            'title' => 'Dev Badge 2',
            'description' => 'Highest ranked Badged',
        ];
        $response = $this->postJson(route('addBadge', $data));

        $this->assertCount(1, Badge::all());
        $response->
            assertStatus(200);
    }

    /** @test */
    public function get_all_badges(){
        $this->withoutExceptionHandling();
        $response = $this->get(route('allBadges'));
        $response->assertStatus(200);
    }

    /** @test */
    public function get_a_single_badge(){
        $badge = Badge::factory()->create()->first();

        $response = $this->get(route('getBadge', $badge->id));
        $response
            ->assertStatus(200);
    }
    /** @test */
    public function a_badge_can_be_patched(){
        $this->withoutExceptionHandling();

        $b = Badge::factory()->create()->first();

        $response = $this->patch('api/badge/updateBadge/' . $b->id, $this->data());

        $b = $b->fresh();

        $this->assertEquals('Updated Badge', $b->title);
        $this->assertEquals('NewBie Badge', $b->description);
    }

    private function data(){
        return [
            'title' => 'Updated Badge',
            'description' =>'NewBie Badge'
        ];
    }

    /** @test */
    public function a_badge_can_be_removed(){
        $this->withoutExceptionHandling();
        $b = Badge::factory()->create()->first();

        $response = $this->delete('api/badge/delete-badge/' . $b->id, $this->data());

        $this->assertCount(0, Badge::all());
    }

}
