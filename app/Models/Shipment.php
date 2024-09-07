<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;

    protected $fillable = ['shipment_name', 'purchase_order_id'];

    public function purchaseOrder()
    {
        return $this->belongsTo(PurchaseOrder::class, 'purchase_order_id');
    }

    public function shipmnetHistores()
    {
        return $this->hasMany(ShipmentStatusHistory::class, 'shipment_id');
    }

    public function shipmentSkds()
    {
        return $this->hasMany(ShipmentSkd::class, 'shipment_id');
    }
}
