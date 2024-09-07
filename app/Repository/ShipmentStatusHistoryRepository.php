<?php

namespace App\Repository;

use App\Models\ShipmentStatusHistory;
use function Symfony\Component\Translation\t;

class ShipmentStatusHistoryRepository
{
    public function __construct(
        protected ShipmentStatusHistory $shipmentStatusHistory
    ){}

    public function index($id)
    {
        return $this->shipmentStatusHistory->where('shipment_id', $id)->get();
    }
    public function store($request)
    {
        return $this->shipmentStatusHistory->create($request);
    }
    public function update($request, $id)
    {
        return $this->shipmentStatusHistory->findOrFail($id)->update($request);
    }

}
