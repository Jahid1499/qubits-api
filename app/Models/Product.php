<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'series_id',
        'display',
        'processor',
        'processor_type',
        'memory',
        'memory_type',
        'storage',
        'description',
        'image',
        'status',
        'verify_status'
    ];

    public function configurations()
    {
        return $this->hasMany(ProductConfigration::class,'product_id','id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function series()
    {
        return $this->belongsTo(Series::class);
    }
}
