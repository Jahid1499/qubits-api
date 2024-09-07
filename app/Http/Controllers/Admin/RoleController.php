<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Services\RoleService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;


class RoleController extends Controller
{

    use ApiResponseTrait;

    private RoleService $roleService;
    public function __construct(RoleService $roleService )
    {
        $this->roleService = $roleService;
    }
    public function index(Request $request)
    {
        $roles = $this->roleService->getAll($request);
        return $this->successResponse($roles, "Roles retrieved successfully", 200);
    }

    public function store(RoleRequest $request)
    {
        $this->roleService->saveRole($request->all());
        return $this->successResponse("", "Role created successfully", 201);
    }

    public function show($id)
    {
        $role = $this->roleService->getRole($id);
        return $this->successResponse($role, "Role found successfully", 200);
    }

    public function update(RoleRequest $request, $id)
    {
        $this->roleService->updateRole($request->all(), $id);
        return $this->successResponse("", "Role update successfully", 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->roleService->deleteRole($id);
        return $this->successResponse("", "Role deleted successfully", 200);
    }

    public function activeRoles(){
       $activeRoles = $this->roleService->activeRoles();
        return $this->successResponse($activeRoles, "Active role retrive successfully", 200);
    }
}
