<?php

namespace App\Repositories;

use App\Models\Service;
use App\Entities\ServiceEntity;

class ServicesRepository
{

    public function getAllServices()
    {
        if(auth()->user()->isAdmin()){
            return Service::all();
        }

        return Service::where('is_available',true)->get();
    }

    public function storeService(ServiceEntity $service)
    {
        return Service::create([
            'name'         => $service->name,
            'description'  => $service->description,
            'price'        => $service->price,
            'is_available' => $service->isAvailable
        ]);
    }

    public function updateService(ServiceEntity $request, ServiceEntity $service)
    {
        $service = Service::find($service->id);

        $service->update([
            'name'         => $request->name,
            'description'  => $request->description,
            'price'        => $request->price,
            'is_available' => $request->isAvailable
        ]);

        return $service->fresh();
    }

    public function deleteService(Service $service)
    {
        return $service->delete();
    }

}
