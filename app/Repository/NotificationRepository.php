<?php

namespace App\Repository;

use App\Models\Notification;
use Carbon\Carbon;

class NotificationRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function add($module)
    {
        foreach ($module['module_rules'] as $rule) {
            Notification::create([
                'user_id' => $rule->user_id,
                'type' => 'none',
                'message' => 'New pending verification',
                'color' => 'blue'
            ]);
        }

        return true;
    }

    public function list($data)
    {
        return Notification::where('user_id', auth()->id())
            ->when(isset($data->status), function ($query) use ($data) {
                $query->where('status', $data->status);
            })
            ->get();
    }

    public function mark_as_read()
    {
        return Notification::where('user_id', auth()->id())
            ->update(['status' => 'read', 'view_date' => Carbon::now()]);
    }
}
