<?php

namespace Tests\Feature;

use App\Models\Comment;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentTest extends TestCase
{

    use RefreshDatabase;
    /** @test */
    public function a_new_comment_can_be_added()
    {

        $this->withoutExceptionHandling();

        $user = User::factory()->create()->first();
        $lesson = Lesson::factory()->create()->first();

        $data = [
            'user_id' => $user->id,
            'lesson_id' => $lesson->id,
            'body' => "I dont like this lesson"
        ];
        $response = $this->postJson(route('addComment', $data));

        $this->assertCount(1, Comment::all());
        $response->assertStatus(200);
    }

    /** @test */
    public function get_all_comment()
    {
        $this->withoutExceptionHandling();
        $response = $this->get(route('allComments'));
        $response->assertStatus(200);
    }

    /** @test */
    public function get_a_single_comment()
    {
        $comment = Comment::factory()->create()->first();

        $response = $this->get(route('getComment', $comment->id));
        $response->
            assertStatus(200);
    }
    /** @test */
    public function a_comment_can_be_patched()
    {
        $this->withoutExceptionHandling();

        $c = Comment::factory()->create()->first();

        $response = $this->patch('api/comment/updateComment/' . $c->id, $this->data());

        $c = $c->fresh();

        $this->assertEquals('I love this Lesson', $c->body);


    }

    private function data()
    {
        return [
            'body' => 'I love this Lesson',
        ];
    }

    /** @test */
    public function a_comment_can_be_removed()
    {
        $this->withoutExceptionHandling();
        $b = Comment::factory()->create()->first();

        $response = $this->delete('api/comment/delete-comment/' . $b->id, $this->data());

        $this->assertCount(0, Comment::all());
    }
}
