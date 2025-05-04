<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Reservation;
use App\Services\ReservationsService;
use App\Exceptions\CancelOldReservations;
use App\Http\Requests\CreateReservationRequest;

class ReservationsController extends Controller
{

    public function __construct(
        private ReservationsService $reservationsService
    ) {
    }

    public function index()
    {
        $reservations = $this->reservationsService->getAllUserReservations();

        return view('dashboard.reservations.index', compact('reservations'));
    }

    public function create(Service $service)
    {
        return view('dashboard.reservations.create', compact('service'));
    }

    public function store(CreateReservationRequest $request, Service $service)
    {
        $this->reservationsService->storeReservation($request->validated(), $service);

        return redirect()->route('reservations.index')
        ->with('success','Reservation created successfully');
    }

    public function destroy(Reservation $reservation)
    {
        try {

            $this->reservationsService->cancelReservation($reservation);
            return redirect()->route('reservations.index')
                ->with('success', 'Reservation cancelled successfully');

        } catch (CancelOldReservations $e) {

            return redirect()->route('reservations.index')->with('error', $e->getMessage());
        }

    }
}
