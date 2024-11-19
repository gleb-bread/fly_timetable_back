<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlightType extends Model
{
    use HasFactory;

    protected $fillable = [
        'type', // Поле, которое разрешено для массового заполнения
    ];

    /**
     * Связь с рейсами (Flight).
     * 
     * Указывает, что у одного типа полета может быть много рейсов.
     */
    public function flights()
    {
        return $this->hasMany(Flight::class);
    }
}
