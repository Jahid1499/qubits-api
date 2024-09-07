<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SuppliersRequest;
use App\Models\Supplier;
use App\Http\Controllers\Controller;
use App\Services\SuppliersServices;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    use ApiResponseTrait;

    public function __construct(
        protected SuppliersServices $suppliersServices
    ){}

    public function activeSuppliers()
    {
        $suppliers = $this->suppliersServices->getActiveSuppliers();
        return $this->successResponse($suppliers, "Suppliers retrieved successfully", 200);
    }

    public function index(Request $request)
    {
        $suppliers = $this->suppliersServices->getSuppliers($request);
        return $this->successResponse($suppliers, "Suppliers retrieved successfully", 200);
    }

    public function store(SuppliersRequest $request)
    {
        $this->suppliersServices->saveSupplier($request->all());
        return $this->successResponse("", "Supplier created successfully", 201);
    }


    public function show(int $id)
    {
        $supplier = $this->suppliersServices->getSupplier($id);
        return $this->successResponse($supplier, "Supplier found successfully", 200);
    }


    public function update(SuppliersRequest $request, int $id)
    {
        $this->suppliersServices->updateSupplier($request->all(), $id);
        return $this->successResponse("", "Supplier update successfully", 200);
    }

    public function destroy(int $id)
    {
        $this->suppliersServices->deleteSupplier($id);
        return $this->successResponse("", "Supplier deleted successfully", 200);
    }
}
