<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;

trait ApiResponseTrait
{

    public function successResponse($data, $message = null, $status = 200): JsonResponse
    {
        return successResponse($message, $data, $status);
    }

    public function errorResponse($message = null, $errors = [], $status = 500): JsonResponse
    {
        return errorResponse($message, $errors, $status);
    }

    public function error_handler($validator): array
    {
        $errors = [];
        foreach ($validator->errors()->getMessages() as $index => $error) {
            $errors[] = ['message' => $error[0]];
        }
        return $errors;
    }

    public function paginatedResponse(LengthAwarePaginator $data = null, $message = null, $status = 200): JsonResponse
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
