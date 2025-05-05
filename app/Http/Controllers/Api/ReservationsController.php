<?php

namespace App\Http\Controllers\Api;

use App\Models\Service;
use App\Models\Reservation;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use App\Services\ReservationsService;
use App\Exceptions\CancelOldReservations;
use App\Http\Requests\CreateReservationRequest;
use Illuminate\Http\Response;

class ReservationsController extends Controller
{
    public function __construct(
        private ReservationsService $reservationsService
    ) {
    }



    /**
     * @OA\Get(
     *     path="/api/reservations",
     *     summary="List all user reservations",
     *     tags={"Reservation"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="List of all user reservations successfully retrieved",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                 properties={
     *                     @OA\Property(property="id", type="integer", example=3),
     *                     @OA\Property(property="serviceName", type="string", example="Coaching Session"),
     *                     @OA\Property(property="reservationDate", type="string", format="date-time", example="2025-06-28 02:34:00"),
     *                     @OA\Property(property="status", type="string", example="active"),
     *                     @OA\Property(property="date", type="string", example="28-06-2025"),
     *                     @OA\Property(property="time", type="string", example="02:34:00")
     *                 }
     *             )
     *         )
     *     )
     * )
     */

    public function index()
    {
        $reservations = $this->reservationsService->getAllUserReservations();

        return Collection::make($reservations);
    }

    /**
     * @OA\Post(
     *     path="/api/services/{service_id}/reservations",
     *     summary="Store reservation",
     *     tags={"Reservation"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="service_id",
     *         in="path",
     *         required=true,
     *         description="ID of the service",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"reservation_date"},
     *             @OA\Property(
     *                 property="reservation_date",
     *                 type="string",
     *                 format="date",
     *                 example="2025-05-15"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Reservation created successfully",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="Reservation created successfully"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid request"
     *     ),
     *     security={{"bearerAuth":{}}}
     * )
     */



    public function store(CreateReservationRequest $request, Service $service)
    {
        $this->reservationsService->storeReservation($request->validated(), $service);

        return response()->json([
            "message" => "Reservation created successfully"
        ], Response::HTTP_CREATED);
    }

    /**
     * @OA\Delete(
     *     path="/api/reservations/{reservation_id}",
     *     summary="Delete reservation",
     *     tags={"Reservation"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="reservation_id",
     *         in="path",
     *         required=true,
     *         description="ID of the reservation to be deleted",
     *         @OA\Schema(
     *             type="integer",
     *             example=1
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Reservation cancelled successfully",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="Reservation cancelled successfully"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Can't cancel this reservation",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="Can't cancel this reservation"
     *             )
     *         )
     *     )
     * )
     */

    public function destroy(Reservation $reservation)
    {
        try {

            $this->reservationsService->cancelReservation($reservation);

            return response()->json([
                "message" => "Reservation cancelled successfully"
            ], Response::HTTP_OK);

        } catch (CancelOldReservations $e) {

            return response()->json([
                "message" => $e->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }

    }
}
