<?php

namespace App\Services;

use App\Repository\ProductRepository;

class ProductService
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getAll($request)
    {
        return $this->productRepository->getAll($request);
    }

    public function save($product)
    {
        if (isset($product['image'])) {
            $product['image'] = uploadImage($product['image'],'products');
        }
        $product =  $this->productRepository->save($product);
        verifyModule(MODULES["PRODUCT"],$product->id);

    }

    public function deleteProductById($id)
    {
        return $this->productRepository->deleteProductById($id);
    }

    public function updateProductById($product, $id)
    {
        if (isset($product['image'])) {
            $product['image'] = uploadImage($product['image'],'products');
        }
        return $this->productRepository->updateProductById($product, $id);
    }

    public function viewById($id)
    {
        return $this->productRepository->viewById($id);
    }
    public function productGroupBySeries($request)
    {
        return $this->productRepository->productGroupBySeries($request);
    }
}
