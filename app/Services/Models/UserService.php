<?php

namespace App\Services\Models;

use App\Exceptions\Models\User\UserNotFoundException;
use App\Models\User;

class UserService
{
    private User $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * @throws UserNotFoundException
     */
    public function find(string $id): User
    {
        $user = $this->model->find($id);

        if (!$user) {
            throw new UserNotFoundException();
        }

        return $user;
    }
}
