<?php

namespace App\Repositories\Database;

use App\Repositories\Contracts\UserRepository;
use App\Models\User;

class DatabaseUserRepository extends DatabaseBaseRepository implements UserRepository
{
    /**
     * Construct the repository.
     *
     * @param \App\Models\User $model
     * @return void
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }
}
