<?php

namespace App\Http\Resources;

use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class New1COrdersResource extends JsonResource
{
    public static $wrap = 'orders';


    public function toArray(Request $request): array
    {
        $collection = [];

        foreach ($this->resource as $item) {
            $item->makeHidden(['created_at', 'updated_at']);
            $item->makeHiddenIf($item->delivery_type == Order::DELIVERY_COURIER, ['delivery_point_id', 'delivery_point_code']);

            $delivery_type = $item->deliveryMethod?->name;

            $products = $item->orderProducts->map(function (OrderProduct $requestProduct) {
                return [
                    'code' => $requestProduct->product->code,
                    'qty' => $requestProduct->quantity,
                    'price' => $requestProduct->price,
                    'sum' => $requestProduct->quantity * $requestProduct->price
                ];
            });
            $gift_products = $item->giftProducts->map(function ($giftProduct) {
                return [
                    'code' => $giftProduct['article'],
                    'qty' => 1,
                    'price' => 0,
                    'sum' => 0
                ];
            });

            $item->unsetRelation('giftProducts');
            $item->unsetRelation('orderProducts');
            $item->unsetRelation('deliveryMethod');

            $data = $item->toArray();
            $data['payment_method'] = 'checkmo';
            $data['delivery_method'] = $item->delivery_type;
            $data['delivery_type'] = $delivery_type;
            $data['products'] = $products;
            $data['gift_products'] = $gift_products;

            if ($item->delivery_type == Order::DELIVERY_SELF_PICKUP)
                $data['pickup_point_id'] = $item->delivery_point_id;

            $data['date'] = $item->created_at->setTimezone('Europe/Moscow')->toAtomString();
            $data['created_at'] = $item->created_at->setTimezone('Europe/Moscow')->toAtomString();

            $collection[] = $data;
        }

        return $collection;
    }
}
