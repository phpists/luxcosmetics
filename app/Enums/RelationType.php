<?php

namespace App\Enums;

enum RelationType: int
{
    case RECOMMENDED = 1;
    case POSSIBLE_LIKED = 2;
    case ALSO_SEE = 3;
}
