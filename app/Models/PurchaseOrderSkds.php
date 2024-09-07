<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderSkds extends Model
{
    use HasFactory;
    protected $table = 'purchase_skds';
    protected $fillable = [
        'quantity',
        'price',
        'weight',
        'skd_id',
        'purchase_order_id'
    ];

    protected $hidden=['created_at','updated_at'];

    public function skd()
    {
        return $this->belongsTo(Skd::class, 'skd_id');
    }

}
