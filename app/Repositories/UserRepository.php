<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository
{

    /**
     * @var User
     */
    protected $user;

    /**
     * userRepository constructor.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Get all user.
     *
     * @return User $user
     */
    public function getAll()
    {
        return $this->user->get();
    }

    /**
     * Get user by id
     *
     * @param $id
     * @return mixed
     */

    public function getById($id)
    {
        return $this->user->find($id);
    }
    /**
     * Save user
     *
     * @param $data
     * @return User
     */

    public function save($data)
    {
        $user = new $this->user;
        $user->name = $data['name'];
        $user->email= $data['email'];
        $user->password = Hash::make($data['password']);
        $user->save();

        return $user->fresh();
    }

    /**
     * Update user
     *
     * @param $data
     * @return User
     */
    public function update($data, $id)
    {

        $user = $this->user->find($id);

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->update();

        return $user;
    }

    /**
     * Delete  user
     *
     * @param $data
     * @return User
     */
    public function delete($id)
    {
        $user = $this->user->find($id);

        $user->delete();

        return $user;
    }
}
