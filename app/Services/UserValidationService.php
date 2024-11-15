<?php

namespace App\Services;

use App\Models\User;

class UserValidationService
{
    /**
     * Проверяет, существует ли уже логин в базе данных.
     *
     * @param string $login
     * @return bool
     */
    public function isLoginTaken(string $login): bool
    {
        return User::where('login', $login)->exists();
    }

    /**
     * Проверяет, существует ли уже email в базе данных.
     *
     * @param string $email
     * @return bool
     */
    public function isEmailTaken(string $email): bool
    {
        return User::where('email', $email)->exists();
    }
}
