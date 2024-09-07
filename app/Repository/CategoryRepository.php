<?php

namespace App\Repository;

use App\Models\Category;

class CategoryRepository
{
    public function getAllActiveCategories()
    {
        return Category::where('status', 'active')->get();
    }
    public function getAll($request)
    {
        return Category::when(isset($request->status), function ($query) use ($request) {
                $query->where('status', "active");
            })
            ->when(isset($request->search), function ($query) use ($request) {
            $query->where('name', 'like', '%' . $request->search . '%');
        })
            ->when(isset($request->sort_by), function ($query) use ($request) {
                $query->orderBy($request->sort_by);
            }, function ($query) {
                $query->orderBy('created_at', 'desc');
            })
            ->paginate($request->limit ?? 10);
    }

    public function saveCategory($request)
    {
        return Category::create($request);
    }

    public function getCategory($id)
    {
        return Category::findOrFail($id);
    }

    public function updateCategory($request, $id)
    {
        return Category::findOrFail($id)->update($request);
    }

    public function deleteCategory($id)
    {
        return Category::findOrFail($id)->delete();
    }

}
