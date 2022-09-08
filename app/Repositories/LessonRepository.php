<?php

namespace App\Repositories;

use App\Models\Lesson;

class LessonRepository
{

    /**
     * @var Lesson
     */
    protected $lesson;

    /**
     * LessonRepository constructor.
     *
     * @param Lesson $lesson
     */
    public function __construct(Lesson $lesson)
    {
        $this->lesson = $lesson;
    }

    /**
     * Get all Lesson.
     *
     * @return Lesson $lesson
     */
    public function getAll()
    {
        return $this->lesson->get();
    }

    /**
     * Get Lesson by id
     *
     * @param $id
     * @return mixed
     */

    public function getById($id)
    {
        return $this->lesson->find($id);
    }
    /**
     * Save Lesson
     *
     * @param $data
     * @return Lesson
     */

    public function save($data)
    {
        $lesson = new $this->lesson;
        $lesson->title = $data['title'];
        $lesson->description = $data['description'];
        $lesson->save();

        return $lesson->fresh();
    }

    /**
     * Update Lesson
     *
     * @param $data
     * @return Lesson
     */
    public function update($data, $id)
    {
        $lesson = $this->lesson->find($id);

        $lesson->title = $data['title'];
        $lesson->description = $data['description'];
        $lesson->update();

        return $lesson;
    }

    /**
     * Delete  Lesson
     *
     * @param $data
     * @return Lesson
     */
    public function delete($id)
    {
        $lesson = $this->lesson->find($id);
        $lesson->delete();

        return $lesson;
    }
}
