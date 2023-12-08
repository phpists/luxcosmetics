<?php

namespace App\Services\Api;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariation;
use App\Models\Property;

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

            if ($product['base_property_title'] == \App\Models\Product::ALL_TYPES[Product::TYPE_VOLUME])
                $product['base_property_id'] = Product::TYPE_VOLUME;
            elseif ($product['base_property_title'] == \App\Models\Product::ALL_TYPES[Product::TYPE_COLOR])
                $product['base_property_id'] = Product::TYPE_COLOR;

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

        }


        $variations = $request->post('variations');

        if (is_array($variations) && count($variations) > 0) {
            foreach ($variations as $variation_group) {
                $products = Product::whereIn('code', $variation_group)->get();
                ProductVariation::query()
                    ->whereIn('product_id', $products->pluck('id')->toArray())
                    ->orWhereIn('variation_id', $products->pluck('id')->toArray())
                    ->delete();

                foreach ($products as $product) {
                    foreach ($products as $variation_product) {
                        if ($product == $variation_product)
                            continue;

                        $product
                            ->product_variations()
                            ->create([
                                'variation_id' => $variation_product->id
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
