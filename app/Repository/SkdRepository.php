<?php

namespace App\Repository;

use App\Models\Skd;

class SkdRepository
{
    public function getAllSkd($request)
    {
        return Skd::with('skd_type')->when(isset($request->search), function ($query) use ($request) {
            $query->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('description', 'like', '%' . $request->search . '%');
        })
            ->when(isset($request->sort_by), function ($query) use ($request) {
                $query->orderBy($request->sort_by);
            }, function ($query) {
                $query->orderBy('created_at', 'desc');
            })
            ->paginate($request->limit ?? 10);
    }

    public function createSkd($data)
    {
        return Skd::create($data);
    }

    public function getSkd($id)
    {
        return Skd::findOrFail($id);
    }

    public function updateSkd($data, $id)
    {
        return Skd::findOrFail($id)->update($data);
    }

    public function deleteSkd($id)
    {
        return Skd::findOrFail($id)->delete();
    }
}
