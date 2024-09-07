<?php

namespace App\Services;

use App\Repository\SeriesRepository;

class SeriesService
{
    private $seriesRepository;
    public function __construct(SeriesRepository $seriesRepository)
    {
        $this->seriesRepository = $seriesRepository;
    }
    public function getAll($request)
    {
        return $this->seriesRepository->getAll($request);
    }

    public function saveSeries($request)
    {
        return $this->seriesRepository->saveSeries($request);
    }

    public function getSeries($id)
    {
        return $this->seriesRepository->getSeries($id);
    }
    public function updateSeries($request, $id)
    {
        return $this->seriesRepository->updateSeries($request, $id);
    }

    public function deleteSeries($id)
    {
        return $this->seriesRepository->deleteSeries($id);
    }
}
