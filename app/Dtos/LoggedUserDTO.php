<?php

namespace App\Dtos;


class LoggedUserDTO{

    public function __construct(
        public string $token
    )
    {

    }

}
