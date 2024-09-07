<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ShipmentStatusHistoryRequest;
use App\Models\ShipmentStatusHistory;
use App\Http\Controllers\Controller;
use App\Services\ShipmentStatusHistoryService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class ShipmentStatusHistoryController extends Controller
{
    use ApiResponseTrait;
    public function __construct(
        protected ShipmentStatusHistoryService $shipmentStatusHistoryService
    ){}

    public function index($id)
    {
        $results = $this->shipmentStatusHistoryService->index($id);
        return $this->successResponse($results, "Shipment history retrieved successfully", 200);

    }
    public function store(ShipmentStatusHistoryRequest $request)
    {
        $this->shipmentStatusHistoryService->store($request->all());
        return $this->successResponse("", "Shipment history created successfully", 200);

    }

    public function update(ShipmentStatusHistoryRequest $request, $id)
    {
        $this->shipmentStatusHistoryService->update($request->all(), $id);
        return $this->successResponse("", "Shipment history updated successfully", 200);
    }
}
