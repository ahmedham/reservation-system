<?php
namespace App\Mappers;

use App\Models\User;
use App\Dtos\ServiceDTO;
use App\Dtos\ReservationDTO;
use App\Entities\ServiceEntity;
use App\Entities\ReservationEntity;
use App\Models\Reservation;
use Carbon\Carbon;

class ReservationsMapper
{

    public static function requestToEntity(array $request, ServiceEntity $service, User $user, $status): ReservationEntity
    {
        return new ReservationEntity(
            null,
            $user->id,
            $service->id,
            $service->name,
            $request['reservation_date'],
            $status,
            null
        );
    }

    public static function modelToEntity(Reservation $reservation): ReservationEntity
    {
        return new ReservationEntity(
            $reservation->id,
            $reservation->user->id,
            $reservation->service->id,
            $reservation->service->name,
            $reservation->reservation_date,
            $reservation->status,
            $reservation->created_at
        );
    }

    public static function toDTO(ReservationEntity $reservationEntity): ReservationDTO
    {
        $createAt = Carbon::parse($reservationEntity->reservationDate);

        return new ReservationDTO(
            $reservationEntity->id,
            $reservationEntity->serviceName,
            $reservationEntity->reservationDate,
            $reservationEntity->status,
            $createAt->format('d-m-Y'),
            $createAt->format('H:i:s'),
        );
    }

    public static function toEntityList($reservations): array
    {
        return $reservations->map(function ($reservation) {
            return self::modelToEntity($reservation);
        })->toArray();
    }

    public static function toDTOList(array $reservationsEntities): array
    {
        return array_map(function ($entity) {
            return self::toDTO($entity);
        }, $reservationsEntities);
    }

}
