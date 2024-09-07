<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSkdConfiguration extends Model
{
    use HasFactory;

    protected $fillable = ['product_configuration_id', 'skd_id'];

    public function skd(){
        return $this->belongsTo(Skd::class,'skd_id' ,'id');
    }


    public function productCOnfig(){
        return $this->belongsToMany(Skd::class);
    }

    public function allSkd(){
        return $this->belongsToMany(Skd::class);
    }

}
