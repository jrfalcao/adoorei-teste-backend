<?php

namespace App\Infrastructure\Persistence\Eloquent;

use App\Domain\Contracts\Repositories\UserRepositoryInterface;
use App\Domain\Entities\User;

class UserRepository implements UserRepositoryInterface
{
    public function findByEmail(string $email)
    {
        return User::where('email', $email)->first();
    }
}
