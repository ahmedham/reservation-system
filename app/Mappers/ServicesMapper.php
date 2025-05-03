<?php
namespace App\Mappers;

use App\Models\Service;
use App\Dtos\ServiceDTO;
use App\Entities\ServiceEntity;

class ServicesMapper
{

    public static function modelToEntity(Service $service): ServiceEntity
    {
        return new ServiceEntity(
            $service->id,
            $service->name,
            $service->description,
            $service->price,
            $service->is_available
        );
    }

    public static function requestToEntity(array $service): ServiceEntity
    {
        return new ServiceEntity(
            $service['id']  ?? null,
            $service['name'],
            $service['description'],
            $service['price'],
            $service['is_available']
        );
    }

    public static function toDTO(ServiceEntity $serviceEntity): ServiceDTO
    {
        return new ServiceDTO(
            $serviceEntity->id,
            $serviceEntity->name,
            $serviceEntity->description,
            $serviceEntity->price,
            $serviceEntity->isAvailable,
        );
    }

    public static function toEntityList($services): array
    {
        return $services->map(function ($service) {
            return self::modelToEntity($service);
        })->toArray();
    }


    public static function toDTOList(array $serviceEntities): array
    {
        return array_map(function ($entity) {
            return self::toDTO($entity);
        }, $serviceEntities);
    }

}
