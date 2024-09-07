<?php

namespace App\Repository;

use App\Models\Series;

class SeriesRepository
{
    public function getAll($request)
    {
        return Series::when(isset($request->status), function ($query) use ($request) {
            $query->where('status', "active");
        })
        ->with('category')->when(isset($request->search), function ($query) use ($request) {
            $query->where('name', 'like', '%' . $request->search . '%');
        })
            ->when(isset($request->sort_by), function ($query) use ($request) {
                $query->orderBy($request->sort_by);
            }, function ($query) {
                $query->orderBy('created_at', 'desc');
            })
            ->paginate($request->limit ?? 10);
    }

    public function saveSeries($request)
    {
        $series = Series::create($request);

        $series->load(['category' => function ($query) {
            $query->select('id', 'name');
        }]);

        return $series;
    }

    public function getSeries($id)
    {
        return Series::with(['category' => function ($query) {
            $query->select('id', 'name');
        }])->findOrFail($id);
    }

    public function updateSeries($request, $id)
    {
        return Series::findOrFail($id)->update($request);
    }

    public function deleteSeries($id)
    {
        return Series::findOrFail($id)->delete();
    }
}
