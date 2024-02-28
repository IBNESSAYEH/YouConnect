<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\UserService;

class AuthService
{
    private $userService;
    private $userRepository;

    public function __construct(UserService $userService, UserRepository $userRepository){
        $this->userService = $userService;
        $this->userRepository = $userRepository;
    }

    public function register($request){
        if(empty($this->userService->validate($request))){
            $user = $this->userRepository->create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'profile' => $request->profile,
            ]);
            return true;
        }else{
            return $this->userService->getValidationErrors();
        };
    }
}




