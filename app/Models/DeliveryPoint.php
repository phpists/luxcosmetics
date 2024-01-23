<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryPoint extends Model
{
    use HasFactory;

    protected $fillable = [
        'lms',
        'pointId',
        'pointCode',
        'name',
        'tariffZone',
        'countryCode',
        'countryName',
        'regionName',
        'areaName',
        'cityCode',
        'cityName',
        'zipCode',
        'shortAddress',
        'fullAddress',
        'metroStation',
        'gpsCoordinates',
        'phoneNumber',
        'maxWeight',
        'maxSize',
        'maxVolume',
        'maxAmount',
        'cardPayment',
        'cashPayment',
        'acceptReturns',
        'openingHoursText',
        'additionalDescription',
        'multiBox'
    ];



}
