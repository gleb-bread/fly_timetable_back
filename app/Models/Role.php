<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    /**
     * Таблица, связанная с моделью.
     *
     * @var string
     */
    protected $table = 'roles';

    /**
     * Атрибуты, которые можно массово заполнять.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'project_type_id',
    ];

    /**
     * Связь с моделью ProjectType.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function projectType()
    {
        return $this->belongsTo(ProjectType::class, 'project_type_id');
    }

    /**
     * Связь с моделью RoleUserAssigment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function roleUserAssigments()
    {
        return $this->hasMany(RoleUserAssigment::class);
    }

    public function rolePermissions(){
        return $this->hasMany(RolePermission::class);
    }
}
