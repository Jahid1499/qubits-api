<?php

namespace App\Repository;

use App\Models\ModuleRule;

class PermissionRepository
{
    public function verification($data)
    {
        return ModuleRule::with('module')->where('user_id', auth()->id())->get()->pluck('module');
    }
}
