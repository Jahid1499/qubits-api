<?php

namespace App\Services;

use App\Repository\PermissionRepository;

class PermissionService
{
    public function __construct(protected PermissionRepository $permissionRepository) {}

    public function verification($data)
    {
        return $this->permissionRepository->verification($data);
    }
}
