<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'invoice_image',
        'price',
        'description',
        'status',
        'supplier_id',
        'verification_status'
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function purchaseOrdersSkds()
    {
        return $this->hasMany(PurchaseOrderSkds::class, 'purchase_order_id');
    }

    public function shipments()
    {
        return $this->hasMany(Shipment::class, 'purchase_order_id');
    }

    public function shipmentHistories()
    {
        return $this->hasManyThrough(ShipmentStatusHistory::class, Shipment::class);
    }


}
