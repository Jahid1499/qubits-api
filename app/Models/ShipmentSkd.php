<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipmentSkd extends Model
{
    use HasFactory;

    protected $fillable = [
        'required_qty',
        'received_qty',
        'price',
        'weight',
        'received_at',
        'skd_id',
        'shipment_id'
    ];

    public function shipment()
    {
        return $this->belongsTo(Shipment::class, 'shipment_id');
    }

    public function skd()
    {
        return $this->belongsTo(Skd::class, 'skd_id');
    }

}
