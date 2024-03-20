<?php

namespace App\Enums;

enum Status:int
{
    case ADMIN = 10;
    case USER = 5;
    case Active = 1;
    case In_Active = 0;
    case Pending = -1;
}
