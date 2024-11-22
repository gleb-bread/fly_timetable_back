<?php

namespace App\Enums;

enum EntityActions: string
{
    case ALL = 'all';
    case GET = 'get';
    case GET_ALL = 'getAll';
    case UPDATE = 'update';
    case DELETE = 'delete';
    case BUY = 'buy';
    case CREATE = 'create';
}
