<?php

namespace App\Services;

use App\Repository\ProductSkdConfigureRepo;

class ProductSkdConfigureService
{

    private $productSkdConfigureRepo;

    public function __construct(ProductSkdConfigureRepo $productSkdConfigureRepo)
    {
        $this->productSkdConfigureRepo = $productSkdConfigureRepo;
    }

    public function getAll($request)
    {
        return $this->productSkdConfigureRepo->getAll($request);
    }

    public function save($request)
    {
        $skdData = array_map(function ($skd) {
            return ['skd_id' => $skd];
        }, $request['skd_id']);
        return $this->productSkdConfigureRepo->save($request, $skdData);
    }

    public function getSkdConfigById($id)
    {
        return $this->productSkdConfigureRepo->getSkdConfigById($id);
    }

    public function updateSkdConfigById($request, $id)
    {
        $skdData = array_map(function ($skd) {
            return ['skd_id' => $skd];
        }, $request['skd_id']);
        return $this->productSkdConfigureRepo->updateSkdConfigById($skdData, $id);
    }
}
