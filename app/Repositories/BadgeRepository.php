<?php

namespace App\Repositories;

use App\Models\Badge;

class BadgeRepository
{

    /**
     * @var Badge
     */
    protected $badge;

    /**
     * badgeRepository constructor.
     *
     * @param Badge $badge
     */
    public function __construct(Badge $badge)
    {
        $this->badge = $badge;
    }

    /**
     * Get all badge.
     *
     * @return Badge $badge
     */
    public function getAll()
    {
        return $this->badge->get();
    }

    /**
     * Get badge by id
     *
     * @param $id
     * @return mixed
     */

    public function getById($id)
    {
        return $this->badge->find($id);
    }
    /**
     * Save badge
     *
     * @param $data
     * @return badge
     */

    public function save($data)
    {
        $badge = new $this->badge;
        $badge->title = $data['title'];
        $badge->description = $data['description'];
        $badge->save();

        return $badge->fresh();
    }

    /**
     * Update badge
     *
     * @param $data
     * @return Badge
     */
    public function update($data, $id)
    {
        $badge = $this->badge->find($id);

        $badge->title = $data['title'];
        $badge->description = $data['description'];
        $badge->update();

        return $badge;
    }

    /**
     * Delete  badge
     *
     * @param $data
     * @return Badge
     */
    public function delete($id)
    {
        $badge = $this->badge->find($id);
        $badge->delete();

        return $badge;
    }
}
