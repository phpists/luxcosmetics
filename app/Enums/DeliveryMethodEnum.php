<?php

namespace App\Enums;

enum DeliveryMethodEnum: string
{

    case CDEK = 'cdek';
    case BOXBERRY = 'boxberry';
    case DPD = 'dpd';
    case RUSSIA_POST = 'russia_post';
    case FIVEPOST = 'fivepost';
    case LOGSIS = 'logsis';

}
