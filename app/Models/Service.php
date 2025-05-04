<?php

namespace App\Models;

use App\Models\User;
use App\Models\Reservation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'is_available'
    ];

    protected $casts = [
        'is_available' => 'boolean'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'reservations')
            ->using(Reservation::class)
            ->withPivot('status')
            ->withTimestamps();
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

}
