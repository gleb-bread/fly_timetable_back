<?php

namespace App\Enums;

enum ResponseMessage: string
{
    case VALIDATION_ERRORS = 'Validation errors';
    case USER_REGISTERED = 'User registered successfully!';
    case LOGIN_FAILED = 'Login failed!';
    case EMAIL_TAKEN = 'The email has already been taken.';
    case LOGIN_TAKEN = 'The login has already been taken.';
    case INVALID_USER_DATA = 'The provided credentials are incorrect.';
    case LOGIN_SUCCESS = 'User logged in successfully.';
    case USER_UNAUTHORIZED = 'User not found or unauthorized.';
    case NOT_FOUND = 'Not found';
}
