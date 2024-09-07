<?php

namespace App\Repository;

use App\Models\PurchaseOrderSkds;

class PurchaseOrderSkdsRepository
{
    public function store($request)
    {
        return PurchaseOrderSkds::create($request);
    }

}


