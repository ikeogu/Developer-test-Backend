<?php

namespace App\Repositories;

use App\Models\Achievement;

class AchievementRepository{

    /**
     * @var Achievement
     */
    protected $achievement;

    /**
     * AchievementRepository constructor.
     *
     * @param Achievement $achievement
     */
    public function __construct(Achievement $achievement)
    {
        $this->achievement = $achievement;
    }

    /**
     * Get all achievement.
     *
     * @return Achievement $achievement
     */
    public function getAll(){
        return $this->achievement->
            get();
    }

    /**
     * Get achievement by id
     *
     * @param $id
     * @return mixed
     */

    public function getById($id){
        return $this->achievement->
            find($id);
    }
    /**
     * Save Achievement
     *
     * @param $data
     * @return Achievement
     */

    public function save($data){
        $achievement = new $this->achievement;
        $achievement->title = $data['title'];
        $achievement->description = $data['description'];
        $achievement->save();

        return $achievement->fresh();
    }

    /**
     * Update Achievement
     *
     * @param $data
     * @return Achievement
     */
    public function update($data,$id){
        $achievement = $this->achievement->find($id);

        $achievement->title = $data['title'];
        $achievement->description = $data['description'];
        $achievement->update();

        return $achievement;
    }

    /**
     * Delete  Achievement
     *
     * @param $data
     * @return Achievement
     */
    public function delete($id){
        $achievement = $this->achievement->
            find($id);
        $achievement->delete();

        return $achievement;
    }

}
