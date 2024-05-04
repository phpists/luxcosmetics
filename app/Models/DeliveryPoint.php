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

    public function deliveryMethod()
    {
        return $this->hasOne(DeliveryMethod::class, 'name', 'lms');
    }

    public function getStreetAttribute(): string
    {
        return trim(explode(',', $this->fullAddress)[$this->getStreetIndex()] ?? '');
    }

    public function getHouseAttribute()
    {
        $i = $this->getStreetIndex() + 1;
        return trim(explode(',', $this->fullAddress)[$i] ?? '');
    }

    public function getStreetIndex(): int
    {
        $address = '';
        $street = 2;

        foreach (explode(',', $this->fullAddress) as $i => $addressPart) {
            foreach (['ул.', ' ул', 'пр-т', 'пр-д', 'мрн', 'пр.', 'б-р'] as $a) {
                if (stripos(strtolower($addressPart), $a) !== false) {
                    $street = $i;
                    $address = $addressPart;
                }
            }
        }

        return $street;
    }

}
