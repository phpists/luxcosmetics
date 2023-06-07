<?php

namespace App\Enums;

enum AvailableOptions: int
{
    case AVAILABLE = 1;
    case NOT_AVAILABLE = 2;
    case DISCONTINUED = 3;
}
