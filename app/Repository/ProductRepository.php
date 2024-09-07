<?php

namespace App\Repository;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductRepository
{
    public function getAll($request)
    {
        return Product::with('category:id,name', 'series:id,name','configurations.productSkdConfig.skd')->paginate($request->limit ?? 10);
    }

    public function save($product)
    {
        return Product::create($product);
    }

    public function updateProductById($product, $id)
    {
        return Product::findOrFail($id)->update($product);
    }

    public function deleteProductById($id)
    {
        return Product::findOrFail($id)->delete();
    }

    public function viewById($id)
    {
        return Product::with('category:id,name', 'series:id,name','configurations.productSkdConfig.skd')->findOrFail($id);
    }
    public function productGroupBySeries($request)
    {
        $query = Product::with([
            'category:id,name',
            'series:id,name',
            'configurations.productSkdConfig.skd'
        ])
        ->select('series_id', DB::raw('count(*) as total_products'))
        ->groupBy('series_id');

        return $query->paginate($request->limit ?? 10);
    }
}
