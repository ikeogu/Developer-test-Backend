<?php

namespace App\Http\Controllers;

use App\Events\LessonWatched;
use App\Models\Lesson;
use App\Models\User;
use App\Services\LessonService;
use Illuminate\Http\Request;
use Exception;


class LessonController extends Controller
{
    //
    /**
     * @var LessonService
     */
    protected $lessonService;

    /**
     * LessonController Constructor
     *
     * @param LessonService $lessonService
     *
     */
    public function __construct(LessonService $lessonService)
    {
        $this->lessonService = $lessonService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = ['status' => 200];

        try {
            $result['data'] = $this->lessonService->getAll();
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only([
            'title',
            'description',
        ]);

        $result = ['status' => 200];

        try {
            $result['data'] = $this->lessonService->savePostData($data);

        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }

    /**
     * Display the specified resource.
     *
     * @param  id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result = ['status' => 200];

        try {
            $result['data'] = $this->lessonService->getById($id);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        return response()->json($result, $result['status']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Lesson $post
     * @return \Illuminate\Http\Response
     */
    /* public function edit(Post $post)
    {
        //
    } */

    /**
     * Update post.
     *
     * @param Request $request
     * @param id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->only([
            'title',
            'description'
        ]);

        $result = ['status' => 200];

        try {
            $result['data'] = $this->lessonService->updatePost($data, $id);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = ['status' => 200];

        try {
            $result['data'] = $this->lessonService->deleteById($id);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        return response()->json($result, $result['status']);
    }

    public function watch_a_lesson(Request $request)
    {
        $request->validate([
            'user_id' => [
                'integer'
            ],
            'lesson_id' => [
                'integer'
            ]
        ]);

        $user = User::find($request->user_id);
        $lesson = Lesson::find($request->lesson_id);
        $data = [
            'user_id' => $user->id,
            'lesson_id' => $lesson->id
        ];

        $this->lessonService->saveWatchedLesson($data);

        event(new LessonWatched($lesson, $user));
    }

}
