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
            'email' => 'johnny12@gmail.com',
            'password'=> '123pass321'
        ];
        $this->post('user/add-user', $data);
        $this->assertCount(1,User::all());

    }
}
