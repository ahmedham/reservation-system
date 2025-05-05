<?php

namespace App\Services;

use App\Dtos\LoggedUserDTO;
use App\Mappers\UserMapper;
use Illuminate\Support\Facades\Hash;
use App\Repositories\UsersRepository;
use App\Exceptions\InvalidCredentialsException;

class UsersService
{
    public function __construct(
        private UsersRepository $usersRepository
    ) {}

    public function registerUser(array $user)
    {
        $userEntity = UserMapper::requestToEntity($user);

        $userEntity->password = Hash::make($userEntity->password);

        $user = $this->usersRepository->registerUser($userEntity);

        $registeredUserEntity = UserMapper::modelToEntity($user);

        return UserMapper::toDTO($registeredUserEntity);
    }


    public function loginUser($loginUserData)
    {
        // $services = $this->servicesRepository->getAllServices();

        // $servicesEntities = ServicesMapper::toEntityList($services);

        // return ServicesMapper::toDTOList($servicesEntities);

        $user = $this->usersRepository->findUserByEmail($loginUserData['email']);
            if(!$user || !Hash::check($loginUserData['password'],$user->password)){
                throw new InvalidCredentialsException('Invalid Credentials');
            }else{
                $token = $user->createToken($user->name.'-AuthToken')->plainTextToken;

                return new LoggedUserDTO(
                    $token
                );
            }

    }

}
