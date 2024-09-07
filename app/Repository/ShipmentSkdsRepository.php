<?php

namespace App\Repository;

use App\Models\ShipmentSkd;

class ShipmentSkdsRepository
{
    public function update($request, $id)
    {
        return ShipmentSkd::findOrFail($id)->update($request);
    }

}
