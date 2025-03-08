<?php

namespace App\Imports;

use App\Models\Product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToCollection;

class ProductPricesImport implements ToCollection, SkipsEmptyRows
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            $product = Product::whereCode($row[0])->first();
            $product->price = $row[1];
            $product->old_price = $row[2] ?? null;
            $product->rrp = $row[3] ?? null;
            $product->discount = $row[4] ?? null;
            $product->points = $row[5] ?? 0;
            $product->save();
        }
    }
}
