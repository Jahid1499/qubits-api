<?php

namespace App\Repository;

use App\Models\SkdType;

class SkdTypeRepository
{
    public function __construct() {}

    public function list()
    {
        return SkdType::all();
    }

    public function add($skd_type_data)
    {
        return SkdType::create($skd_type_data);
    }
}
