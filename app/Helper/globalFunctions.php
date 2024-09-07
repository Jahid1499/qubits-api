<?php

use App\Services\VerifyService;
use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;

const MODULES = [
    "PURCHASE_ORDER" => "po",
    "SHIPMENT_SKD" => "shipmentSkd",
    "SHIPMENT" => "sh",
    "RETURN_REQUEST" => "rr",
    "INVOICE" => "in",
    "ORDER_RETURN" => "or",
    "ORDER_CANCELATION" => "oc",
    "PRODUCT_RETURN" => "pr",
    "PRODUCT" => "product",
    "PRODUCT_CONFIG" => "product_config"
];

if (!function_exists('verifyModule')) {
    function verifyModule($slug, $item_id)
    {
        $verify_service = app(VerifyService::class);
        return $verify_service->add($slug, $item_id);
    }
}

if (!function_exists('uploadImage')) {
    function uploadImage($image, $directory, $old_image = null)
    {
        if ($image && $image->isValid()) {

            if (isset($old_image)) Storage::disk('public')->delete($directory . $old_image);

            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs($directory, $imageName, 'public');
            return $path;
        }

        return null;
    }
}

if (!function_exists('removeImage')) {
    function removeImage($filePath)
    {
        if (Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->delete($filePath);

            return true;
        }

        return false;
    }
}

if (!function_exists('successResponse')) {
    function successResponse($message = null, $data = [], $status = 200): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data'    => $data,
        ], $status);
    }
}

if (!function_exists('errorResponse')) {
    function errorResponse($message = null, $errors = [], $status = 500): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'errors'    => $errors,
        ], $status);
    }
}

if (!function_exists('validationErrors')) {
    function validationErrors($validator): array
    {
        $errors = [];
        foreach ($validator->errors()->getMessages() as $index => $error) {
            $errors[] = ['message' => $error[0]];
        }
        return $errors;
    }
}

if (!function_exists('paginatedResponse')) {
    function paginatedResponse(LengthAwarePaginator $data = null, $message = null, $status = 200): JsonResponse
    {
        return response()->json([
            'success'   => true,
            'message'   => $message,
            'data'      => $data->items(),
            'meta_data' => [
                'total'          => $data->total(),
                'per_page'       => $data->perPage(),
                'current_page'   => $data->currentPage(),
                'last_page'      => $data->lastPage(),
                'from'           => $data->firstItem(),
                'to'             => $data->lastItem(),
                'links'          => $data->linkCollection(),
                'first_page_url' => $data->url(1),
                'last_page_url'  => $data->url($data->lastPage()),
                'next_page_url'  => $data->nextPageUrl(),
                'prev_page_url'  => $data->previousPageUrl(),
            ],
        ], $status);
    }
}
