<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    /**
     * Указываем, какие поля могут быть заполнены массово.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'flight_id',
        'count',
    ];

    /**
     * Устанавливаем отношения с моделью User.
     * Один пользователь может иметь много записей в корзине.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Устанавливаем отношения с моделью Flight.
     * Каждая запись корзины связана с конкретным рейсом.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function flight()
    {
        return $this->belongsTo(Flight::class);
    }
}
