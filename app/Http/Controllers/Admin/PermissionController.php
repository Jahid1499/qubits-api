<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\PermissionService;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function __construct(protected PermissionService $permissionService)
    {
        
    }

    public function verification(Request $request)
    {
        $verifications =  $this->permissionService->verification($request->all());

        return successResponse("Verification permission successfully retive", $verifications);
    }
}
