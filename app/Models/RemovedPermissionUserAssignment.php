<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RemovedPermissionUserAssignment extends Model
{
    use HasFactory;

    /**
     * Таблица, связанная с моделью.
     *
     * @var string
     */
    protected $table = 'removed_permission_user_assigment';

    /**
     * Атрибуты, которые можно массово заполнять.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_assigment_id',
        'permission_id',
    ];

    /**
     * Связь с моделью UserAssignment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function userAssignment()
    {
        return $this->belongsTo(UserAssigment::class, 'user_assigment_id');
    }

    /**
     * Связь с моделью Permission.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function permission()
    {
        return $this->belongsTo(Permission::class, 'permission_id');
    }
}
