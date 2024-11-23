<?php

namespace App\Enums;

enum Entity: string
{
    case ALL = 'all';
    case FLIGHT = 'flight';
    case FLIGHT_TYPE = 'flightType';
    case USER = 'user';
    case RIGHT = 'right';
    case ACTION = 'action';
    case ENTITY = 'entity';
    case PERMISSION = 'permission';
    case PROJECT = 'project';
    case PROJECT_TYPE = 'projectType';
    case ROLE = 'role';
}
