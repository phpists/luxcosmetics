<?php

namespace App\Enums;

enum ConnectionOptions: int
{
    case EMAIL = 1;
    case SMS = 2;
    case PHONE = 3;

    case WHATSAPP = 4;
}
