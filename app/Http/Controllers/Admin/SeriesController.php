<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SeriesRequest;
use App\Services\SeriesService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    use ApiResponseTrait;

    private SeriesService $seriesService;
    public function __construct(SeriesService $seriesService)
    {
        $this->seriesService = $seriesService;
    }
    public function index(Request $request)
    {
        $series = $this->seriesService->getAll($request);
        return $this->successResponse($series, "Series retrieved successfully", 200);
    }
    public function store(SeriesRequest $request)
    {
        $this->seriesService->saveSeries($request->all());
        return $this->successResponse("", "Series created successfully", 201);
    }

    public function show($id)
    {
        $series = $this->seriesService->getSeries($id);
        return $this->successResponse($series, "Series found successfully", 200);
    }
    public function update(SeriesRequest $request, $id)
    {
        $this->seriesService->updateSeries($request->all(), $id);
        return $this->successResponse("", "Series update successfully", 200);
    }
    public function destroy($id)
    {
        $this->seriesService->deleteSeries($id);
        return $this->successResponse("", "Series deleted successfully", 200);
    }
}
