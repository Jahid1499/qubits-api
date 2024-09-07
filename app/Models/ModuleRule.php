<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModuleRule extends Model
{
    use HasFactory;

    protected $fillable = ['module_id', 'user_id'];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}
