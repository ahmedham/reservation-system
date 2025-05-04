<?php

namespace App\Repositories;

use App\Entities\ReservationEntity;
use App\Models\Reservation;

class ReservationsRepository
{
    public function getAllUserReservations()
    {
        return auth()->user()->reservations;
    }
    public function storeReservation(ReservationEntity $reservation)
    {
        Reservation::create([
            'user_id'         => $reservation->userId,
            'service_id'  => $reservation->serviceId,
            'status'        => $reservation->status,
            'reservation_date' => $reservation->reservationDate
        ]);
    }


    public function cancelReservation(Reservation $reservation)
    {
        return $reservation->update(
            [
                'status'=> 'cancelled'
            ]
        );
    }
}
