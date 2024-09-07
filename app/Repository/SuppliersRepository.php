<?php

namespace App\Repository;

use App\Models\Supplier;
use Exception;

class SuppliersRepository
{
    public function findById(int $id)
    {
        return Supplier::findOrFail($id);
    }

    // get all suppliers
    public function getSuppliers($request)
    {
        return Supplier::when(isset($request->status), function ($query) use ($request) {
                $query->where('status', "active");
            })
            ->when(isset($request->search), function ($query) use ($request) {
            $query->where('supplier_name', 'like', '%' . $request['search'] . '%')
                ->orWhere('company_name', 'like', '%' . $request['search'] . '%')
                ->orWhere('address', 'like', '%' . $request['search'] . '%')
                ->orWhere('phone', 'like', '%' . $request['search'] . '%')
                ->orWhere('email', 'like', '%' . $request['search'] . '%');
        })
            ->when(isset($request->sort_by), function ($query) use ($request) {
                $query->orderBy($request->sort_by);
            }, function ($query) {
                $query->orderBy('created_at', 'desc');
            })->paginate($request->limit ?? 10);
    }

    public function getSupplier(int $id)
    {
        return Supplier::findOrFail($id);
    }

    public function getActiveSuppliers()
    {
        return Supplier::where('status', 'active')->get();
    }

    public function createSupplier($data)
    {
        return Supplier::create($data);
    }

    public function updateSupplier($request, $id)
    {
        return Supplier::findOrFail($id)->update($request);
    }

    public function deleteSupplier($id)
    {
        return Supplier::findOrFail($id)->delete();
    }
}
