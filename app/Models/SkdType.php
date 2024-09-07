<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkdType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'barcode_prefix',
        'barcode_status'
    ];
}
