<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\NotificationService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected NotificationService $notificationService) {}

    public function index(Request $request)
    {
        $notifications =  $this->notificationService->list($request);
        return successResponse("Notifications retrieved successfully", $notifications);
    }

    public function update(string $id)
    {
        $this->notificationService->mark_as_read();
        return successResponse("Notifications marked as read");
    }
}
