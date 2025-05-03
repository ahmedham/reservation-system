<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Services\ServicesService;
use App\Http\Requests\CreateServiceRequest;
use App\Http\Requests\UpdateServiceRequest;

class ServicesController extends Controller
{
    public function __construct(
        private ServicesService $servicesService
    ) {}

    public function index()
    {
        $services = $this->servicesService->getAllServices();

        return view('dashboard.services.index', compact('services'));
    }

    public function create()
    {
        return view('dashboard.services.create');
    }

    public function store(CreateServiceRequest $request)
    {
        $this->servicesService->storeService($request->validated());

        return redirect()->route('services.index');
    }

    public function edit(Service $service)
    {
        $service = $this->servicesService->editService($service);

        return view('dashboard.services.edit', compact('service'));
    }

    public function update(UpdateServiceRequest $request, Service $service)
    {
        $this->servicesService->updateService($request->validated(), $service);

        return redirect()->route('services.index');
    }

    public function destroy(Service $service)
    {
        $this->servicesService->deleteService($service);

        return redirect()->route('services.index');
    }
}
