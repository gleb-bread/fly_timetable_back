<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Application extends Model
{
    /**
     * Таблица, связанная с моделью.
     *
     * @var string
     */
    protected $table = 'applications';

    /**
     * Массово заполняемые поля.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'flight_id',
        'count',
        'order_id',
    ];

    /**
     * Получение пользователя, связанного с заявкой.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Получение рейса, связанного с заявкой.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function flight(): BelongsTo
    {
        return $this->belongsTo(Flight::class);
    }
}
