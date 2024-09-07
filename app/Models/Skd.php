<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skd extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'skd_type_id',
        'status',
    ];

    protected $hidden = ['created_at', 'updated_at'];

    public function scopeActive(Builder $query)
    {
        $query->where('status', 'active');
    }

    public function skd_type()
    {
        return $this->belongsTo(SkdType::class, 'skd_type_id');
    }
}
