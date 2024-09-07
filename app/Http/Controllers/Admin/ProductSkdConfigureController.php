<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductSkdConfigRequest;
use App\Services\ProductSkdConfigureService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class ProductSkdConfigureController extends Controller
{

    use ApiResponseTrait;
    private $productSkdConfigureService;
    public function __construct(ProductSkdConfigureService $productSkdConfigureService)
    {
        $this->productSkdConfigureService = $productSkdConfigureService;
    }

    public function index(Request $request)
    {
        $productSkdConfigurations = $this->productSkdConfigureService->getAll($request);
        return $this->successResponse($productSkdConfigurations, "Product Skd Configurations retrieved successfully", 200);
    }


    public function store(ProductSkdConfigRequest $request)
    {
        $this->productSkdConfigureService->save($request->all());
        return $this->successResponse("", "Product Skd Configurations saved successfully", 201);
    }


    public function show(int $id)
    {
        $productSkdConfiguration = $this->productSkdConfigureService->getSkdConfigById($id);
        return $this->successResponse($productSkdConfiguration, "Product Skd Configuration found successfully", 200);
    }


    public function update(ProductSkdConfigRequest $request, int $id)
    {
        $this->productSkdConfigureService->updateSkdConfigById($request->all(), $id);
        return $this->successResponse("","Product Skd Configuration Updated successfully", 200);
    }
}
