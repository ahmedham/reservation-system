<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\ServicesService;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Collection;


class ServicesController extends Controller
{

    public function __construct(
        private ServicesService $servicesService
    ) {

        $this->middleware('can:is-admin')->except('index');
    }


    /**
     * @OA\Get(
     *     path="/api/services",
     *     summary="List all services",
     *     tags={"Service"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Successful list of all services",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                 properties={
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="name", type="string", example="Consultation"),
     *                     @OA\Property(property="description", type="string", example="Professional consultation service"),
     *                     @OA\Property(property="price", type="number", format="float", example=150),
     *                     @OA\Property(property="isAvailable", type="boolean", example=true)
     *                 }
     *             )
     *         )
     *     )
     * )
     */

    public function index()
    {
        $services = $this->servicesService->getAllServices();

        return Collection::make($services);
    }
}
