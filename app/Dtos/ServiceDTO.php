<?php

namespace App\Dtos;


class ServiceDTO{

    public function __construct(
        public ?int $id,
        public string $name,
        public string $description,
        public float $price,
        public ?bool $isAvailable
    )
    {

    }

}
