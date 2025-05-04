<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Reservation extends Pivot
{
    use HasFactory;

    protected $table = 'reservations';
    protected $fillable = ['user_id', 'service_id', 'status','reservation_date'];

    public static function getNewReservationStatus()
    {
        return "active";
    }


    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }

    public function service()
    {
        return $this->hasOne(Service::class,'id','service_id');
    }
}
