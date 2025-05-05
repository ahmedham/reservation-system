<?php
namespace App\Mappers;

use App\Dtos\UserDTO;
use App\Entities\UserEntity;
use App\Models\User;

class UserMapper
{

    public static function modelToEntity(User $user): UserEntity
    {
        return new UserEntity(
            $user->id,
            $user->name,
            $user->email,
            $user->password,
        );
    }

    public static function requestToEntity(array $user): UserEntity
    {
        return new UserEntity(
            $user['id']  ?? null,
            $user['name'],
            $user['email'],
            $user['password']
        );
    }

    public static function toDTO(UserEntity $userEntity): UserDTO
    {
        return new UserDTO(
            $userEntity->id,
            $userEntity->name,
            $userEntity->email,
            $userEntity->password
        );
    }

    // public static function toEntityList($services): array
    // {
    //     return $services->map(function ($service) {
    //         return self::modelToEntity($service);
    //     })->toArray();
    // }


    // public static function toDTOList(array $userEntities): array
    // {
    //     return array_map(function ($entity) {
    //         return self::toDTO($entity);
    //     }, $serviceEntities);
    // }

}
