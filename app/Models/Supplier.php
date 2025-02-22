<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'supplier_name',
        'company_name',
        'address',
        'phone',
        'email',
        'product',
        'contact_person',
        'website',
        'bank_info',
        'status',
    ];

    protected $hidden = ['created_at','updated_at'];
}
