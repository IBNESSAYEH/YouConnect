<?php

namespace App\Repositories;

use App\Models\User;
use App\Services\UserService;
class UserRepository implements UserRepositoryInterface
{
    private $user;

    public function __construct(UserService $userService){
        $this->user = $userService;
    }

    public function create(array $userData){

            $user = User::create($userData);
    }
}