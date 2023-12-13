<?php

namespace App\Services\Api;

use App\Enums\AvailableOptions;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Property;
use App\Models\RelatedProduct;
use Illuminate\Support\Arr;

class ProductService
{


    /**
     * @throws \Exception
     */
    public function import($request)
    {
        $products = $request->post('products');

        foreach ($products as $product) {
            $dbProduct = Product::firstOrNew(['code' => $product['code']]);

            if ($product['category_title']) {
                $category = Category::firstOrCreate(
                    [
                        'name' => $product['category_title']
                    ],
                    [
                        'alias' => \Str::slug($product['category_title'])
                    ]
                );
                $product['category_id'] = $category->id;
            }

            if ($product['brand_title']) {
                $brand = Brand::firstOrCreate(
                    [
                        'name' => $product['brand_title']
                    ]
                );
                $product['brand_id'] = $brand->id;
            }

            if (isset($product['base_property'])
                && ($product['base_property'] == Product::TYPE_VOLUME
                    || $product['base_property'] == Product::TYPE_COLOR)) {
                $product['base_property_id'] = $product['base_property'];
            } else {
                if ($product['base_property_title'] == \App\Models\Product::ALL_TYPES[Product::TYPE_VOLUME])
                    $product['base_property_id'] = Product::TYPE_VOLUME;
                elseif ($product['base_property_title'] == \App\Models\Product::ALL_TYPES[Product::TYPE_COLOR])
                    $product['base_property_id'] = Product::TYPE_COLOR;
            }

            if (!isset($product['base_property']))
                $product['base_property'] = Product::TYPE_VOLUME;

            if ($product['items_left'] > 0) {
                $product['availability'] = AvailableOptions::AVAILABLE->value;
            } else {
                $product['availability'] = AvailableOptions::NOT_AVAILABLE->value;
            }

            $dbProduct->fill($product);
            if (!$dbProduct->save()) {
                throw new \Exception('Не удалось сохранить/обновить товар');
            }

            if (isset($product['properties']) && is_array($product['properties'])) {
                $dbProduct->propertyValues()->delete();
                foreach ($product['properties'] as $property_id => $property_value) {
                    $property = Property::find($property_id);
                    if ($property) {
                        $property_value = $property->values()->firstOrCreate(['value' => $property_value]);
                        $dbProduct->propertyValues()->create([
                            'property_id' => $property->id,
                            'property_value_id' => $property_value->id
                        ]);
                    }
                }
            }

            $dbProduct->product_variations()->delete();
            if (isset($product['variations'])) {
                $variations = explode(',', $product['variations']);
                foreach ($variations as $variation_code) {
                    $variation = Product::whereCode($variation_code)->first();
                    if ($variation) {
                        $dbProduct
                            ->product_variations()
                            ->create([
                                'variation_id' => $variation->id,
                            ]);
                    }
                }
            }

            $dbProduct->related_products()->delete();

            if (isset($product['similar_products'])) {
                $similar_products = explode(',', $product['similar_products']);
                foreach ($similar_products as $similar_product_code) {
                    $similar = Product::whereCode($similar_product_code)->first();
                    if ($similar) {
                        $dbProduct
                            ->related_products()
                            ->create([
                                'relative_product_id' => $similar->id,
                                'relation_type' => RelatedProduct::SIMILAR_ITEMS
                            ]);
                    }
                }
            }

            if (isset($product['related_products'])) {
                $related_products = explode(',', $product['related_products']);
                foreach ($related_products as $related_product_code) {
                    $related = Product::whereCode($related_product_code)->first();
                    if ($related) {
                        $dbProduct
                            ->related_products()
                            ->create([
                                'relative_product_id' => $related->id,
                                'relation_type' => RelatedProduct::SUPPORT_ITEMS
                            ]);
                    }
                }
            }

        }
    }

    /**
     * @throws \Exception
     */
    public function updateStocks($request)
    {
        $products = $request->post('products');

        foreach ($products as $product) {
            $existingProduct = Product::whereCode($product['code'])->first();
            if (!$existingProduct) {
                throw new \Exception("Не удалось найти товар з артикулом {$product['code']}");
            }
            $existingProduct->update($product);
        }
    }


}
