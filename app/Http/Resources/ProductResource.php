<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Indicates if the resource's collection keys should be preserved.
     *
     * @var bool
     */
    public bool $preserveKeys = true;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title' => $this->title,
            'alias' => $this->alias,
            'code' => $this->code,
            'code_1c' => $this->code_1c,
            'category' => $this->category,
            'status' => $this->status,
            'price' => $this->price,
            'old_price' => $this->old_price,
            'discount' => $this->discount,
            'discount_price' => $this->discount_price,
            'base_property_id' => $this->base_property_id,
            'brand_id' => $this->brand_id,
            'availability' => $this->availability,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'show_in_discount' => $this->show_in_discount,
            'show_in_popular' => $this->show_in_popular,
            'show_in_new' => $this->show_in_new,
            'show_in_sales_page' => $this->show_in_sales_page,
            'show_in_percent_discount_page' => $this->show_in_percent_discount_page,
            'show_in_new_page' => $this->show_in_new_page,
            'size' => $this->size,
            'points' => $this->points,
            'description_meta' => $this->description_meta,
            'keywords_meta' => $this->keywords_meta,
            'og_title_meta' => $this->og_title_meta,
            'og_description_meta' => $this->og_description_meta,
            'height_product' => $this->height_product,
            'width_product' => $this->width_product,
            'length_product' => $this->length_product,
            'weight_product' => $this->weight_product,
            'country_products' => $this->country_products,
            'storage_conditions' => $this->storage_conditions,
            'allergy' => $this->allergy,
            'spyrt' => $this->spyrt,
            'expiry_date' => $this->expiry_date,
            'items_left' => $this->items_left,
            'similar_products' => RelatedProductResource::collection($this->similarProducts),
            'support_products' => RelatedProductResource::collection($this->supportProducts),
            'brand' => $this->brand,
            'properties' => PropertyValueResource::collection($this->values)
        ];
    }
}
