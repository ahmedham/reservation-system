<?php

namespace App\Dtos;


class ReservationDTO{

    public function __construct(
        public ?int $id,
        public string $serviceName,
        public string $reservationDate,
        public string $status,
        public ?string $date,
        public ?string $time
    )
    {
    }

}
