<?php

namespace App\Dtos;


class UserDTO{

    public function __construct(
        public ?int $id,
        public string $name,
        public string $email,
        public string $password,
    )
    {

    }

}
