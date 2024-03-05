<?php

namespace App\Domain\Contracts\Repositories;

interface UserRepositoryInterface
{
    public function findByEmail(string $email);
}
