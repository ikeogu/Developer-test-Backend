<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function a_user_can_be_added(){

        $this->withoutExceptionHandling();
        $data = [
            'name'=> 'John Doe',
            'email' => 'johnny14@gmail.com',
            'password'=> '123pass321'
        ];
        $response = $this->postJson(route('user.addUser', $data));
        $this->assertCount(1, User::all());
        $response
            ->assertStatus(200);

    }

    /** @test */

    public function get_a_user(){

        $user = User::factory()->create()->first();

        $response = $this->get(route('user.getUser',$user->id));
        $response
            ->assertStatus(200);


    }

    /** @test */
    public function fetch_all_users(){
        $this->withoutExceptionHandling();
        $response = $this->get(route('user.getAllUsers'));
        $response->assertStatus(200);

    }
    /** @test */

    public function a_user_can_be_patched(){
        $this->withoutExceptionHandling();

        $user = User::factory()->create()->first();

        $response = $this->patch('api/user/updateUser/'. $user->id, $this->data());

        $user = $user->fresh();

        $this->assertEquals('Emman Dev', $user->name);
        $this->assertEquals('dev@gmail.com',$user->email);

    }

    private function data(){
        return [
            'name'=> "Emman Dev",
            'email' => 'dev@gmail.com',
            'password' => 'Emman@Dev2'
        ];
    }

    /** @test */
    public function a_user_can_be_removed(){
        $this->withoutExceptionHandling();
        $user = User::factory()->create()->first();

        $response = $this->delete('api/user/delete-user/' . $user->id, $this->data());

        $this->assertCount(0,User::all());
    }

    /** @test */
    public function user_has_achievement()
    {
        $this->withoutExceptionHandling();
        
        $user = User::factory()->create();

        $response = $this->get(route('achievement.user_achievement',$user->id));

        $response->assertStatus(200);
    }

}
