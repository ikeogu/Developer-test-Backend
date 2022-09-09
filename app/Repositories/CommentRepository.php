<?php

namespace App\Repositories;

use App\Events\CommentWritten;
use App\Models\Comment;
use App\Models\User;

class CommentRepository
{

    /**
     * @var Comment
     */
    protected $Comment;

    /**
     * CommentRepository constructor.
     *
     * @param Comment $Comment
     */
    public function __construct(Comment $Comment)
    {
        $this->Comment = $Comment;
    }

    /**
     * Get all Comment.
     *
     * @return Comment $Comment
     */
    public function getAll()
    {
        return $this->Comment->get();
    }

    /**
     * Get Comment by id
     *
     * @param $id
     * @return mixed
     */

    public function getById($id)
    {
        return $this->Comment->find($id);
    }
    /**
     * Save Comment
     *
     * @param $data
     * @return Comment
     */

    public function save($data)
    {

        $Comment = new $this->Comment;
        $Comment->body = $data['body'];
        $Comment->user_id = $data['user_id'];
        $Comment->lesson_id = $data['lesson_id'];
        $Comment->save();

        // return $Comment->fresh();
        $user = User::find($Comment->user_id);

        event(new CommentWritten($Comment, $user));
    }

    /**
     * Update Comment
     *
     * @param $data
     * @return Comment
     */
    public function update($data, $id)
    {
        $Comment = $this->Comment->find($id);

        $Comment->body = $data['body'];
        $Comment->user_id = empty($data['user_id']) ? $Comment->user_id : $data['user_id'];
        $Comment->lesson_id  = empty($data['lesson_id']) ? $Comment->lesson_id : $data['lesson_id'];
        $Comment->update();

        return $Comment;
    }

    /**
     * Delete  Comment
     *
     * @param $data
     * @return Comment
     */
    public function delete($id)
    {
        $Comment = $this->Comment->find($id);
        $Comment->delete();

        return $Comment;
    }
}
