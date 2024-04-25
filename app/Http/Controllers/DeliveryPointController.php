<?php

namespace App\Http\Controllers;

use App\Http\Resources\DeliveryPointResource;
use App\Models\DeliveryPoint;

class DeliveryPointController extends Controller
{

    public function index()
    {
        $deliveryPoints = DeliveryPoint::select(['delivery_points.*', 'delivery_methods.title as deliveryMethodTitle'])
            ->leftJoin('delivery_methods', 'delivery_points.lms', '=', 'delivery_methods.name')
            ->filtered()->get();

        return DeliveryPointResource::collection($deliveryPoints);
    }

}
