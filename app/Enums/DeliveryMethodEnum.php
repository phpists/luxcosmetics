<?php

namespace App\Enums;

enum DeliveryMethodEnum: string
{

    case CDEK = 'cdek';
    case BOXBERRY = 'boxberry';
    case DPD = 'dpd';
    case RUSSIA_POST = 'russia_pos';
    case FIVEPOST = 'fivepost';
    case LOGSIS = 'logsis';

}
