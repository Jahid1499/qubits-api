<?php

namespace App\Services;

use App\Repository\ShipmentSkdsRepository;

class ShipmentSkdsService
{
    public function __construct(
        protected ShipmentSkdsRepository $shipmentSkdsRepository
    ){}

    public function update($request, $id)
    {
        return $this->shipmentSkdsRepository->update($request, $id);
    }

}
