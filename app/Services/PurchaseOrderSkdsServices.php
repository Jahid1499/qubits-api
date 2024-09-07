<?php

namespace App\Services;

use App\Repository\PurchaseOrderSkdsRepository;

class PurchaseOrderSkdsServices
{
    public function __construct(protected PurchaseOrderSkdsRepository $purchaseOrderSkdsRepository){}

    public function store($request)
    {
        return $this->purchaseOrderSkdsRepository->store($request);
    }

}
