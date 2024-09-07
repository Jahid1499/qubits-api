<?php

namespace App\Repository;

use App\Models\ProductConfigration;
use App\Models\ProductSkdConfiguration;

class ProductSkdConfigureRepo
{
    public function getAll($request)
    {
        return ProductSkdConfiguration::with('skd')->paginate($request->limit ?? 10);
    }

    public function save($request, $skdData)
    {
        $productConfig = ProductConfigration::findOrFail($request['product_configuration_id']);
        $productConfig->productSkdConfig()->createMany($skdData);
        return true;
    }

    public function getSkdConfigById($id)
    {
        return ProductSkdConfiguration::with('skd')->findOrFail($id);
    }

    public function updateSkdConfigById($skdData, $id)
    {
        ProductSkdConfiguration::where('product_configuration_id',$id)->delete();
        $productConfig = ProductConfigration::findOrFail($id);
        $productConfig->productSkdConfig()->createMany($skdData);
    }
}
