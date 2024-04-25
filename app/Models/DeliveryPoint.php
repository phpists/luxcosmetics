<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
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


    public function scopeFiltered(Builder $builder): void
    {
        $builder
            ->when($lms = request('lms'), function ($query) use ($lms) {
                return $query->where('lms', $lms);
            })
            ->when($city = request('cityName'), function ($query) use ($city) {
                return $query->where('cityName', $city);
            });
    }

}
