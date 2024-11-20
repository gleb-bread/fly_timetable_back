<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleUserAssigment extends Model
{
    use HasFactory;

    /**
     * Таблица, связанная с моделью.
     *
     * @var string
     */
    protected $table = 'role_user_assigment';

    /**
     * Атрибуты, которые можно массово заполнять.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_assigment_id',
        'role_id',
    ];

    /**
     * Связь с моделью UserAssigment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function userAssigment()
    {
        return $this->belongsTo(UserAssigment::class);
    }

    /**
     * Связь с моделью Role.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
