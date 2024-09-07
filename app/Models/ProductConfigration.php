<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductConfigration extends Model
{
    use HasFactory;
    protected $fillable = ['product_id','name', 'verify_status'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function productSkdConfig(){
        return $this->hasMany(ProductSkdConfiguration::class, 'product_configuration_id');
    }
}
