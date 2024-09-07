<?php

namespace App\Services;

use App\Repository\PurchaseOrderRepository;

class PurchaseOrderService
{
    public function __construct(
        protected PurchaseOrderRepository $purchaseOrderRepository,
        protected PurchaseOrderSkdsServices $purchaseOrderSkdsServices
    ){}

    public function index($request)
    {
        return $this->purchaseOrderRepository->index($request);
    }
    public function show($id)
    {
        return $this->purchaseOrderRepository->show($id);
    }

    public function store($request)
    {
        $newPo = $this->purchaseOrderRepository->store($request);
        verifyModule(MODULES["PURCHASE_ORDER"], $newPo->id);
        $purchaseOrderSkds = $this->purchaseOrderRepository->purchaseOrderSkds($newPo->id);
        foreach ($purchaseOrderSkds->shipments as $shipments) {
            verifyModule(MODULES["SHIPMENT_SKD"], $shipments->id);
        }
        return $purchaseOrderSkds;
    }

    public function update($request, $id)
    {
        return $this->purchaseOrderRepository->update($request, $id);
    }

    public function cancel($id)
    {
        return $this->purchaseOrderRepository->cancel($id);
    }

    public function destroy($id)
    {
        return $this->purchaseOrderRepository->destroy($id);
    }

}
