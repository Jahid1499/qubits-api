<?php

namespace App\Http\Requests;

use App\Traits\ApiResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class SkdRequest extends FormRequest
{
    use ApiResponseTrait;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'   => 'required|string|max:255',
            'status' => 'string|in:active,inactive',
            'description' => 'string',
            'skd_type_id' => 'required|exists:skd_types,id',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            errorResponse("Validation error", validationErrors($validator), 422)
        );
    }
}
