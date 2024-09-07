<?php

namespace App\Repository;

use App\Models\Module;
use App\Models\ModuleRule;
use Exception;
use Illuminate\Support\Facades\DB;

class ModuleRepository
{
    public function list($request)
    {
        return Module::with('module_rules')
            ->when(isset($request->status), function ($query) use ($request) {
                $query->where('status', "active");
            })
            ->when(isset($request->search), function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%');
            })
            ->when(isset($request->sort_by), function ($query) use ($request) {
                $query->orderBy($request->sort_by);
            }, function ($query) {
                $query->orderBy('created_at');
            })
            ->paginate($request->limit ?? 10);
    }

    public function store($data)
    {
        DB::beginTransaction();

        try {
            $module = Module::create($data);

            if (isset($data['module_rules_user_ids'])) {
                $moduleRules = array_map(function ($userId) {
                    return ['user_id' => $userId];
                }, $data['module_rules_user_ids']);

                $module->module_rules()->createMany($moduleRules);
            }
            DB::commit();

            return $module;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function show($id)
    {
        return Module::with('module_rules')->findOrFail($id);
    }

    public function update($data, $id)
    {
        DB::beginTransaction();

        try {
            $module = Module::findOrFail($id);

            $module->update($data);

            if (isset($data['module_rules_user_ids'])) {
                $moduleRules = array_map(function ($userId) {
                    return ['user_id' => $userId];
                }, $data['module_rules_user_ids']);

                $module->module_rules()->delete();
                $module->module_rules()->createMany($moduleRules);
            }
            DB::commit();

            return $module;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function delete($id)
    {
        $module = Module::findOrFail($id)->delete();
    }
}
