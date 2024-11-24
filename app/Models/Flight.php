<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory;

    protected $fillable = [
        'flight_type_id',
        'departure_from',
        'destination',
        'flight_number',
        'departure_time',
        'arrival_time',
    ];

    /**
     * Связь с типами полетов (FlightType).
     */
    public function flightType()
    {
        return $this->belongsTo(FlightType::class);
    }

    /**
     * Связь с корзинами (Cart).
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cart()
    {
        return $this->hasMany(Cart::class, 'flight_id');
    }
}
