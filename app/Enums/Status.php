<?php

namespace App\Enums;

enum Status:int
{
    case Active = 1;
    case In_Active = 0;
    case Pending = -1;
}
