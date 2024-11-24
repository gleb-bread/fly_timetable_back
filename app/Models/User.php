<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * Атрибуты, которые можно массово заполнять.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "login",
        "name",
        "second_name",
        "email",
        "password",
    ];

    /**
     * Атрибуты, скрытые при сериализации.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Преобразование типов атрибутов.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    /**
     * Связь пользователя с назначениями (UserAssignment).
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function assignments()
    {
        return $this->hasMany(UserAssigment::class, 'user_id');
    }

    /**
     * Связь пользователя с проектами через назначения.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function projects()
    {
        return $this->hasManyThrough(Project::class, UserAssigment::class, 'user_id', 'id', 'id', 'project_id');
    }

    public function roleUserAssigment(){
        return $this->hasManyThrough(RoleUserAssigment::class, UserAssigment::class, 'user_id', 'user_assigment_id', 'id', 'id');
    }

    /**
     * Связь пользователя с корзиной (Cart).
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function carts()
    {
        return $this->hasMany(Cart::class, 'user_id');
    }

}
