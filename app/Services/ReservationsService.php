<?php

namespace App\Services;

use App\Exceptions\CancelOldReservations;
use App\Models\Service;
use App\Models\Reservation;
use App\Mappers\ServicesMapper;
use App\Mappers\ReservationsMapper;
use App\Repositories\ReservationsRepository;
use Exception;

class ReservationsService
{
    public function __construct(
        private ReservationsRepository $reservationsRepository
    ) {
    }

    public function getAllUserReservations()
    {
        $reservations = $this->reservationsRepository->getAllUserReservations();

        $reservationsEntities = ReservationsMapper::toEntityList($reservations);

        return ReservationsMapper::toDTOList($reservationsEntities);

    }

    public function storeReservation(array $request, Service $service)
    {
        $currentUser   = auth()->user();
        $serviceEntity = ServicesMapper::modelToEntity($service);
        $status        = Reservation::getNewReservationStatus();
        $reservationEntity = ReservationsMapper::requestToEntity($request, $serviceEntity, $currentUser, $status);

        $this->reservationsRepository->storeReservation($reservationEntity);

    }


    public function cancelReservation(Reservation $reservation)
    {
        if($reservation->reservation_date < now()){
            throw new CancelOldReservations("Can't cancel this reservations");
        }

        $this->reservationsRepository->cancelReservation($reservation);

    }
}
