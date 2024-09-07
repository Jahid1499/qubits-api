<?php

namespace App\Repository;


use App\Models\Role;
use http\Exception\InvalidArgumentException;

class RoleRepository
{

    public function __construct(protected Role $role){}

    public function getAll($request)
    {
        return Role::when(isset($request->status), function ($query) use ($request) {
                $query->where('status', "active");
            })->get();
    }

    public function saveRole($request)
    {
        return Role::create($request);
    }

    public function getRole($id)
    {
        return Role::findOrFail($id);
    }

    public function updateRole($request, $id)
    {
        return Role::findOrFail($id)->update($request);
    }

    public function deleteRole($id)
    {
        return $this->role->findOrFail($id)->delete();
    }

    public function findByName($name)
    {
        return $this->role->where('name', $name)->first();
    }

    public function activeRoles()
    {
        return $this->role->where('status', 'active')->get();
    }


}
