<?php

namespace App\Repository;

use App\Models\SkdInventory;

class ShipmentToInventoryRepository
{
    public function getInventoryBySkdId($id)
    {
        return SkdInventory::where('skd_id', $id)->first();
    }
    public function insert($data)
    {
        return SkdInventory::create($data);
    }
}
