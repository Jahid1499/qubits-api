<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;
use App\Services\ProductService;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{

    use ApiResponseTrait;

    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }


    public function index(Request $request)
    {
        $products = $this->productService->getAll($request);
        return $this->successResponse($products, "Products retrieved successfully", 200);
    }

    public function store(ProductRequest $request)
    {
        $this->productService->save($request->all());
        return $this->successResponse("", "Product created successfully", 201);
    }


    public function show(int $id)
    {
        $product =  $this->productService->viewById($id);
        return $this->successResponse($product, "Product found successfully", 200);
    }


    public function update(ProductRequest $request, int $id)
    {
        $this->productService->updateProductById($request->all(), $id);
        return $this->successResponse("", "Product update successfully", 200);
    }

    public function destroy($id)
    {
        $this->productService->deleteProductById($id);
        return $this->successResponse("", "Product deleted successfully", 200);
    }

    public function productGroupBySeries(Request $request)
    {
        $productGroupBySeries = $this->productService->productGroupBySeries($request);
        return $this->successResponse($productGroupBySeries, "Series wise Product  retrived successfully", 200);
    }

}
