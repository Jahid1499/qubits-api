<?php

namespace App\Repository;

use App\Models\ProductConfigration;

class ProductConfigurationRepository
{
    public function getAll($request)
    {
        return ProductConfigration::with('product','productSkdConfig','productSkdConfig.skd')->paginate($request->limit ?? 10);
    }

    public function save($request)
    {
        return ProductConfigration::create($request);
    }

    public function viewById($id)
    {
        return ProductConfigration::with('product','productSkdConfig','productSkdConfig.skd')->findOrFail($id);
    }

    public function updateProductConfigurationById($request,$id)
    {
        return ProductConfigration::findOrFail($id)->update($request);
    }
}
