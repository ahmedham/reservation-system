<?php

namespace App\Repositories;

use App\Models\Service;
use App\Entities\ServiceEntity;
use App\Models\User;

class UsersRepository
{


    public function registerUser($user): User
    {
        return User::create([
            'name' => $user->name,
            'email' => $user->email,
            'password' => $user->password
        ]);

    }

    public function findUserByEmail($email): User
    {
        return User::where('email', $email)->first();
    }

}
