<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ModuleRequest;
use App\Services\ModuleService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    public function __construct(protected ModuleService $service) {}

    public function index(Request $request)
    {
        $services = $this->service->list($request);
        return successResponse("Modules retrieved successfully", $services);
    }

    public function store(ModuleRequest $request)
    {
        $this->service->store($request->all());
        return successResponse("Modules created successfully");
    }

    public function show($id)
    {
        $service = $this->service->show($id);
        return successResponse("Modules found successfully", $service);
    }

    public function update(ModuleRequest $request, $id)
    {
        $service = $this->service->update($request->all(), $id);
        return successResponse("Modules update successfully");
    }

    public function destroy($id)
    {
        $this->service->delete($id);
        return successResponse("Modules deleted successfully");
    }
}
