<?php

namespace App\Services;

use App\Repository\ShipmentStatusHistoryRepository;

class ShipmentStatusHistoryService
{
    public function __construct(
        protected ShipmentStatusHistoryRepository $shipmentStatusHistoryRepository
    ){}

    public function index($id)
    {
        return $this->shipmentStatusHistoryRepository->index($id);
    }
    public function store($request)
    {
        return $this->shipmentStatusHistoryRepository->store($request);
    }

    public function update($request, $id)
    {
        return $this->shipmentStatusHistoryRepository->update($request, $id);
    }

}
