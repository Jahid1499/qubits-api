<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PurchaseOrderRequest;
use App\Models\PurchaseOrder;
use App\Http\Controllers\Controller;
use App\Services\PurchaseOrderService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
    use ApiResponseTrait;
    public function __construct(protected PurchaseOrderService $purchaseOrderService){}

    public function index(Request $request)
    {
        $purchaseOrders = $this->purchaseOrderService->index($request);
        return $this->successResponse($purchaseOrders, "Purchase order retrieved successfully", 200);
    }

    public function store(PurchaseOrderRequest $request)
    {
        $this->purchaseOrderService->store($request->all());
        return $this->successResponse("", "Purchase order created successfully", 201);
    }

    public function show($id)
    {
        $purchaseOrder = $this->purchaseOrderService->show($id);
        return $this->successResponse($purchaseOrder, "Purchase order retrieved successfully", 200);
    }
    public function cancel($id)
    {
        $this->purchaseOrderService->cancel($id);
        return $this->successResponse("", "Purchase order cancel successfully", 200);
    }

    public function update(PurchaseOrderRequest $request, $id)
    {
        $this->purchaseOrderService->update($request->all(), $id);
        return $this->successResponse("", "Purchase order update successfully", 200);
    }
    public function destroy(int $id)
    {
        $this->purchaseOrderService->destroy($id);
        return $this->successResponse("", "Purchase order deleted successfully", 200);
    }
}
