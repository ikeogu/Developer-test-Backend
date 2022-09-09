<?php

namespace App\Services;

use App\Models\Comment;
use App\Repositories\CommentRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class CommentService
{
    /**
     * @var $CommentRepository
     */
    protected $CommentRepository;

    /**
     * PostService constructor.
     *
     * @param CommentRepository $CommentRepository
     */
    public function __construct(CommentRepository $CommentRepository)
    {
        $this->CommentRepository = $CommentRepository;
    }

    /**
     * Delete post by id.
     *
     * @param $id
     * @return String
     */
    public function deleteById($id)
    {
        DB::beginTransaction();

        try {
            $post = $this->CommentRepository->delete($id);
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to delete post data');
        }

        DB::commit();

        return $post;
    }

    /**
     * Get all post.
     *
     * @return String
     */
    public function getAll()
    {
        return $this->CommentRepository->getAll();
    }

    /**
     * Get post by id.
     *
     * @param $id
     * @return String
     */
    public function getById($id)
    {
        return $this->CommentRepository->getById($id);
    }

    /**
     * Update post data
     * Store to DB if there are no errors.
     *
     * @param array $data
     * @return String
     */
    public function updatePost($data, $id)
    {
        $validator = Validator::make($data, [
            'body' => 'string',
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        DB::beginTransaction();

        try {
            $post = $this->CommentRepository->update($data, $id);
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to update post data');
        }

        DB::commit();

        return $post;
    }

    /**
     * Validate post data.
     * Store to DB if there are no errors.
     *
     * @param array $data
     * @return String
     */
    public function savePostData($data)
    {

        $validator = Validator::make($data, [
            'body' => 'required',
            'user_id' => 'required',
            'lesson_id'=> 'required'
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        $result = $this->CommentRepository->save($data);

        return $result;
    }
}
