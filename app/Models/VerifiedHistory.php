<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerifiedHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'module_id',
        'module_slug',
        'module_item_id',
        'user_id',
        'status',
        'date',
        'remark'
    ];

    public function verifier()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
