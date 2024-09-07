<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SkdRequest;
use App\Services\SkdService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class SkdController extends Controller
{
    private $skd_service;

    public function __construct(SkdService $skd_service)
    {
        $this->skd_service = $skd_service;
    }

    public function index(Request $request)
    {
        $data = $this->skd_service->getAllSkd($request);
        return successResponse('Skds Fetched Successfully', $data);
    }

    public function store(SkdRequest $request)
    {
        $this->skd_service->createSkd($request->all());
        return successResponse('Skd Successfully Created!');
    }

    public function show(string $id)
    {
        $data = $this->skd_service->getSkd($id);
        return successResponse('Skd Fetched Successfully', $data);
    }

    public function update(SkdRequest $request, string $id)
    {
        $this->skd_service->updateSkd($request->all(), $id);
        return successResponse('Skd Successfully Updated!');
    }

    public function destroy(string $id)
    {
        $this->skd_service->deleteSkd($id);
        return successResponse('Skd Successfully Removed!');
    }
}
