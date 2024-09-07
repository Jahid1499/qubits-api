<?php

namespace App\Services;


use App\Repository\RoleRepository;

class RoleService
{
    private $roleRepository;
    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function getAll($request)
    {
        return $this->roleRepository->getAll($request);
    }

    public function saveRole($request)
    {
        return $this->roleRepository->saveRole($request);
    }

    public function getRole($id)
    {
        return $this->roleRepository->getRole($id);
    }
    public function updateRole($request, $id)
    {
        return $this->roleRepository->updateRole($request, $id);
    }

    public function deleteRole($id)
    {
        return $this->roleRepository->deleteRole($id);
    }

    public function activeRoles()
    {
        return $this->roleRepository->activeRoles();
    }
}
