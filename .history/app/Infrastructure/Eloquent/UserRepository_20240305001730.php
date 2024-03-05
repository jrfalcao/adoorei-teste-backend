<?php

namespace App\Infrastructure\Persistence\Eloquent;

use App\Domain\User\Repository\UserRepositoryInterface;
use App\Domain\User\Entity\User;

class UserRepository implements UserRepositoryInterface
{
    public function findByEmail(string $email)
    {
        return User::where('email', $email)->first();
    }
}
