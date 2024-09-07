<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'updated_col',
        'updated_col_val',
        'model_name',
        'service_and_method'
    ];

    public function scopeSlug($query, $slug)
    {
        return $query->where('slug', $slug);
    }

    public function module_rules()
    {
        return $this->hasMany(ModuleRule::class);
    }
}
