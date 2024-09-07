<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipmentStatusHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'shipment_id',
        'status_name',
        'amount',
        'confirm_or_shipment_date',
        'received_date',
        'c&f',
        'c&f_bills',
        'cost_note'
    ];

    public function shipment()
    {
        return $this->belongsTo(Shipment::class, 'shipment_id');
    }
}
