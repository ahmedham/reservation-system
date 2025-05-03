<?php

namespace App\Services;

use App\Models\Service;
use App\Mappers\ServicesMapper;
use App\Repositories\ServicesRepository;

class ServicesService
{
    public function __construct(
        private ServicesRepository $servicesRepository
    ) {}

    public function getAllServices()
    {
        $services = $this->servicesRepository->getAllServices();

        $servicesEntities = ServicesMapper::toEntityList($services);

        return ServicesMapper::toDTOList($servicesEntities);
    }

    public function storeService(array $service)
    {
        $serviceEntity = ServicesMapper::requestToEntity($service);

        $service = $this->servicesRepository->storeService($serviceEntity);

        $serviceEntity = ServicesMapper::modelToEntity($service);

        return ServicesMapper::toDTO($serviceEntity);
    }


    public function editService(Service $service)
    {
        $serviceEntity = ServicesMapper::modelToEntity($service);

        return ServicesMapper::toDTO($serviceEntity);
    }

    public function updateService(array $request, Service $service)
    {
        $requestEntity = ServicesMapper::requestToEntity($request);

        $serviceEntity = ServicesMapper::modelToEntity($service);

        $serviceModel = $this->servicesRepository->updateService($requestEntity, $serviceEntity);

        $serviceEntity = ServicesMapper::modelToEntity($serviceModel);

        return ServicesMapper::toDTO($serviceEntity);
    }


    public function deleteService(Service $service)
    {
        return $this->servicesRepository->deleteService($service);
    }
}
