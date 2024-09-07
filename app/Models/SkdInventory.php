<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkdInventory extends Model
{
    use HasFactory;
    protected $fillable = [
        'insert_date',
        'confirmer',
        'shipment_skd_id',
        'skd_id',
    ];
}
