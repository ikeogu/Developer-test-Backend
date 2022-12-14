<?php

namespace App\Http\Controllers;

use App\Events\CommentWritten;
use App\Events\LessonWatched;
use App\Models\Achievement;
use App\Models\Badge;
use App\Models\Comment;
use App\Models\Lesson;
use App\Models\User;
use App\Services\AchievementService;
use Illuminate\Http\Request;
use DB;
use Dotenv\Parser\Lexer;
use Illuminate\Validation\Rules\Exists;
use Exception;

class AchievementsController extends Controller
{

    public function __construct(AchievementService $achievementService)
    {
        $this->achievementService = $achievementService;
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
            $result['data'] = $this->achievementService->getAll();
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
            $result['data'] = $this->achievementService->savePostData($data);
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
            $result['data'] = $this->achievementService->getById($id);
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
     * @param Achievement $post
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
            $result['data'] = $this->achievementService->updatePost($data, $id);
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
            $result['data'] = $this->achievementService->deleteById($id);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        return response()->json($result, $result['status']);
    }


    public function index2(User $user)
    {

       $user_acheivements = $user->achievements;
        $next_available_achievements = Achievement::
            whereNotIn('id', $user_acheivements->pluck('id')->toArray())->
            get();

        if(!empty($user_acheivements)){
            $current_badge = $user->badges()->latest()->first();
            $id = !empty($current_badge) ? $current_badge->id : 0;
            $next_badges = Badge::where('id', '>', $id)->first();
            $remaing_to_unlock_next_badge = Badge::where('id', '<>', $id)->get();

            return response()->json([
                'unlocked_achievements' => $user_acheivements->pluck('title'),
                'next_available_achievements' => $next_available_achievements->pluck('title'),
                'current_badge' => $current_badge->title ?? '',
                'next_badge' => $next_badges->title ?? '',
                'remaing_to_unlock_next_badge' => $remaing_to_unlock_next_badge->count()
            ]);
        }

    }

}
