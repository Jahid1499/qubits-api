<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductConfigurationRequest;
use App\Services\ProductConfigurationService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class ProductConfigurationController extends Controller
{

    use ApiResponseTrait;
    protected $productConfigurationService;

    public function __construct(ProductConfigurationService $productConfigurationService)
    {
        $this->productConfigurationService = $productConfigurationService;
    }

    public function index(Request $request)
    {
        $productConfiguration = $this->productConfigurationService->getAll($request);
        return $this->successResponse($productConfiguration, "Product Configuration retrieved successfully", 200);
    }

    public function store(ProductConfigurationRequest $request)
    {
        $this->productConfigurationService->save($request->all());
        return $this->successResponse("", "Product Configuration created successfully", 201);
    }


    public function show(int $id)
    {
        $productConfiguration = $this->productConfigurationService->viewById($id);
        return $this->successResponse($productConfiguration, "Product Configuration found successfully", 200);
    }

    public function update(ProductConfigurationRequest $request, int $id)
    {
        $this->productConfigurationService->updateProductConfigurationById($request->all(),$id);
        return $this->successResponse("", "Product update successfully", 200);
    }


}
