<?php

namespace App\Domain\User\Repository;

interface UserRepositoryInterface
{
    public function findByEmail(string $email);
}
