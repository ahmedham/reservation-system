<?php

namespace App\Entities;

class ReservationEntity
{
    public function __construct(
        public ?int $id,
        public int $userId,
        public int $serviceId,
        public string $serviceName,
        public string $reservationDate,
        public string $status,
        public ?string $createdAt,
    ) {}
}
