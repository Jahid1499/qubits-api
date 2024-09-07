<?php

namespace App\Services;

use App\Models\ShipmentSkd;
use App\Repository\ShipmentToInventoryRepository;

class ShipmentSkdToInventoryService
{
    public function __construct(
        protected ShipmentToInventoryRepository $shipmentToInventoryRepository
    ){}

    public function shipmentSkdToInventory($id)
    {
        $shipmentSkds = ShipmentSkd::findOrFail($id);
        $data = [
            "shipment_skd_id" => $shipmentSkds->id,
            "skd_id" => $shipmentSkds->skd_id,
            "quantity" => $shipmentSkds->quantity,
            "insert_date" => date("Y-m-d H:i:s"),
        ];
        $this->shipmentToInventoryRepository->insert($data);
    }

}
