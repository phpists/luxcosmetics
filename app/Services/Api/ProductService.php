<?php

namespace App\Services\Api;

use App\Enums\AvailableOptions;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariation;
use App\Models\Property;
use App\Models\RelatedProduct;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

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

            if ($dbProduct->availability == AvailableOptions::DISCONTINUED->value)
                continue;

            if ($product['category_title']) {
                $category = Category::firstOrCreate(
                    [
                        'name' => trim($product['category_title'])
                    ],
                    [
                        'alias' => \Str::slug($product['category_title']),
                        'position' => 999
                    ]
                );
                $product['category_id'] = $category->id;
            }

            if ($product['brand_title']) {
                $brand = Brand::firstOrCreate(
                    [
                        'name' => trim($product['brand_title'])
                    ],
                    [
                        'link' => \Str::slug($product['brand_title'])
                    ]
                );
                $product['brand_id'] = $brand->id;
            }

            if (isset($product['base_property'])
                && ($product['base_property'] == Product::TYPE_VOLUME
                    || $product['base_property'] == Product::TYPE_COLOR)) {
                $product['base_property_id'] = $product['base_property'];
            } elseif(isset($product['base_property_title'])) {
                if ($product['base_property_title'] == \App\Models\Product::ALL_TYPES[Product::TYPE_VOLUME])
                    $product['base_property_id'] = Product::TYPE_VOLUME;
                elseif ($product['base_property_title'] == \App\Models\Product::ALL_TYPES[Product::TYPE_COLOR])
                    $product['base_property_id'] = Product::TYPE_COLOR;
            }

            if (!isset($product['base_property']))
                $product['base_property'] = Product::TYPE_VOLUME;

            if (!$dbProduct->exists && !isset($product['alias']))
                $product['alias'] = Str::slug($product['title']);

            if (!$dbProduct->exists) {
                $dbProduct->size = '';
                $dbProduct->price = 0;
                $dbProduct->show_in_discount = 0;
                $dbProduct->show_in_popular = 0;
                $dbProduct->show_in_new = 0;
            }

            $dbProduct->fill($product);
            if (!$dbProduct->save()) {
                throw new \Exception('Не удалось сохранить/обновить товар');
            }

            if (isset($product['properties']) && is_array($product['properties'])) {
                $dbProduct->propertyValues()->delete();
                foreach ($product['properties'] as $property) {
                    if (empty(trim($property['property_value'])))
                        continue;

                    $dbProperty = Property::find($property['property_id']);
                    if ($dbProperty) {
                        $dbPropertyValue = $dbProperty->values()->firstOrCreate([
                            'property_id' => $dbProperty->id,
                            'value' => trim($property['property_value'])
                        ]);
                        $dbProduct->propertyValues()->create([
                            'property_id' => $dbProperty->id,
                            'property_value_id' => $dbPropertyValue->id
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
                        if (!ProductVariation::whereProductId($dbProduct->id)->whereVariationId($variation->id)->exists()) {
                            $dbProduct
                                ->product_variations()
                                ->create([
                                    'variation_id' => $variation->id,
                                ]);
                        }

                        if (!ProductVariation::whereProductId($variation->id)->whereVariationId($dbProduct->id)->exists()) {
                            $variation
                                ->product_variations()
                                ->create([
                                    'variation_id' => $dbProduct->id,
                                ]);
                        }
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

            $dbProduct->productCategories()->delete();

            if (isset($product['additional_categories']) && is_array($product['additional_categories'])) {
                foreach ($product['additional_categories'] as $additionalCategory) {
                    $dbAdditionalCategory = Category::firstOrCreate(
                        [
                            'name' => trim($additionalCategory)
                        ],
                        [
                            'alias' => \Str::slug($additionalCategory),
                            'position' => 999
                        ]
                    );
                    $dbProduct->productCategories()->create(['category_id' => $dbAdditionalCategory->id]);
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
            if (!$existingProduct)
                continue;

            if ($product['items_left'] > 0) {
                $product['availability'] = AvailableOptions::AVAILABLE->value;
            } else {
                $product['availability'] = AvailableOptions::NOT_AVAILABLE->value;
            }

            if ($existingProduct->availability !== AvailableOptions::DISCONTINUED->value)
                $existingProduct->update([
                    'items_left' => $product['items_left'],
                    'availability' => $product['availability']
                ]);
        }
    }


}
