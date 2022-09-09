<?php

namespace Tests\Feature;

use App\Models\Achievement;
use App\Models\Badge;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LessonTest extends TestCase
{
    use RefreshDatabase;

   /** @test */
    public function a_lesson_can_be_added(){
        $this->withoutExceptionHandling();
        $data = [
            'title' => 'Introduction to programming',
            'description' => 'Get to know how to code',
        ];
        $response = $this->postJson(route('addLesson', $data));

        $this->assertCount(1, Lesson::all());
        $response->assertStatus(200);
    }

    /** @test */
    public function get_all_lessons(){
        $this->withoutExceptionHandling();
        $response = $this->get(route('allLessons'));
        $response->assertStatus(200);
    }

    /** @test */
    public function get_a_lesson(){
        $lesson = Lesson::factory()->create()->first();

        $response = $this->get(route('getLesson', $lesson->id));
        $response ->
            assertStatus(200);
    }
    /** @test */
    /** @test */
    public function a_lesson_can_be_patched()
    {
        $this->withoutExceptionHandling();

        $l = Lesson::factory()->create()->first();

        $response = $this->patch('api/lesson/updateLesson/' . $l->id, $this->data());

        $l = $l->fresh();

        $this->assertEquals('Updated Lesson COurse', $l->title);
        $this->assertEquals('Introduction to CSC', $l->description);
    }

    private function data()
    {
        return [
            'title' => 'Updated Lesson COurse',
            'description' => 'Introduction to CSC'
        ];
    }

    /** @test */
    public function a_lesson_can_be_removed()
    {
        $this->withoutExceptionHandling();
        $b = Lesson::factory()->create()->first();

        $response = $this->delete('api/lesson/delete-less/' . $b->id, $this->data());

        $this->assertCount(0, Lesson::all());
    }

    /** @test */
    public function watch_a_lesson(){

        $this->withoutExceptionHandling();

        $user = User::factory()->create()->first();
        $lesson = Lesson::factory()->create()->first();
        Achievement::factory()->count(8)->create();
        Badge::factory()->count(7)->create();


        $data = [
            'user_id' => $user->id,
            'lesson_id' => $lesson->id

        ];

        $response = $this->postJson(route('watch_a_lesson'),$data);
        $response->assertStatus(200);

    }

}

