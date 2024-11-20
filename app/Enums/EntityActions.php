<?php

namespace App\Enums;

enum EntityActions: string
{
    case ALL = 'all';
    case GET = 'get';
    case UPDATE = 'update';
    case DELETE = 'delete';
    case BUY = 'buy';
    case CREATE = 'create';
}
