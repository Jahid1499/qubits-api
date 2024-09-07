<?php

namespace App\Services;

use App\Repository\ProductConfigurationRepository;

class ProductConfigurationService{

    protected $productConfigurationRepository;

    public function __construct(ProductConfigurationRepository $productConfigurationRepository)
    {
        $this->productConfigurationRepository = $productConfigurationRepository;
    }

    public function getAll($request){
        return $this->productConfigurationRepository->getAll($request);
    }

    public function save($request){
        $productConfig =  $this->productConfigurationRepository->save($request);
        verifyModule(MODULES["PRODUCT_CONFIG"], $productConfig->id);
    }

    public function viewById($id){
        return $this->productConfigurationRepository->viewById($id);
    }

    public function updateProductConfigurationById($request,$id){
        return $this->productConfigurationRepository->updateProductConfigurationById($request,$id);
    }
}
