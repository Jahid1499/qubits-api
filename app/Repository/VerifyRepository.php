<?php

namespace App\Repository;

use App\Models\Module;
use App\Models\VerifiedHistory;
use Carbon\Carbon;
use Exception;

class VerifyRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct() {}

    public function findModuleBySlug($slug)
    {
        return Module::with('module_rules')->slug($slug)->first();
    }

    public function add($module, $item_id)
    {
        foreach ($module['module_rules'] as $rule) {
            VerifiedHistory::create([
                'module_id' => $module->id,
                'module_slug' => $module->slug,
                'module_item_id' => $item_id,
                'user_id' => $rule->user_id,
                'status' => 'pending',
                'date' => Carbon::now(),
                'remark' => '',
            ]);
        }

        return true;
    }

    public function verify_module($data)
    {

        $module = Module::slug($data['slug'])->first();
        VerifiedHistory::where('module_id', $module->id)
            ->where('module_item_id', $data['item_id'])
            ->where('user_id', auth()->id())
            ->update([
                'status' => $data['status'],
                'date' => Carbon::now(),
                'remark' => $data['remark'],
            ]);


        $allVerified = !VerifiedHistory::where('module_id', $module->id)
            ->where('module_item_id', $data['item_id'])
            ->where('status', '!=', 'verified')
            ->exists();

        if ($allVerified) {
            try {
                $module->model_name::findOrFail($data['item_id'])
                    ->update([$module->updated_col => $module->updated_col_val]);
                [$class, $method] = explode('@', $module->service_and_method);
                app($class)->$method();
            } catch (Exception $e) {
                throw new Exception('Something wrong');
            }
        }

        return true;
    }

    public function history($data)
    {
        $module = Module::slug($data['slug'])->first();

        return VerifiedHistory::with('verifier')->where('module_id', $module->id)
            ->where('module_item_id', $data['item_id'])
            ->get();
    }
}
