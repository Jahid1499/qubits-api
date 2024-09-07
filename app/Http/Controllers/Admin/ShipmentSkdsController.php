<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShipmentSkdsRequest;
use App\Services\ShipmentSkdsService;
use Illuminate\Http\Request;

class ShipmentSkdsController extends Controller
{
    public function __construct(
        protected ShipmentSkdsService $shipmentSkdsService
    ){}

    public function update(ShipmentSkdsRequest $request, $id)
    {
        $this->shipmentSkdsService->update($request->all(), $id);
        return successResponse("Shipment skd successfully updated", null, 200);
    }
}
