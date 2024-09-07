<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SkdTypeRequest;
use App\Services\SkdTypeService;

class SkdTypeController extends Controller
{
    public function __construct(protected SkdTypeService $skdTypeService) {}

    public function index()
    {
        $skd_types =  $this->skdTypeService->list();
        return successResponse("Skd type successfully retrive", $skd_types);
    }

    public function store(SkdTypeRequest $request)
    {
        $skdtype = $this->skdTypeService->add($request->all());
        return successResponse("Skd type successfully created.",  $skdtype);
    }
}
