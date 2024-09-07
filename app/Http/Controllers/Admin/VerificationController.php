<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\VerifyService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected VerifyService $verifyService) {}

    public function verify_module(Request $request)
    {
        $message = $this->verifyService->verify_module($request);

        return successResponse($message);
    
    }

    public function history(Request $request)
    {
        $histories = $this->verifyService->history($request->all());
        return successResponse("Successfully retrive", $histories);
    }
}
