<?php

namespace App\Entities;

class ServiceEntity
{
    public function __construct(
        public ?int $id,
        public string $name,
        public string $description,
        public float $price,
        public ?bool $isAvailable
    ) {}
}
