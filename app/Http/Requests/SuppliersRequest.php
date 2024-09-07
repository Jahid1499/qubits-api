<?php

namespace App\Http\Requests;

use App\Traits\ApiResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class SuppliersRequest extends FormRequest
{
    use ApiResponseTrait;
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
            'supplier_name' => 'required|min:3|max:255',
            'company_name' => 'required|min:3|max:255',
            'address' => 'required|min:3|max:255',
            'phone' => 'required|min:11|max:18',
            'email' => 'required|email',
            'product' => 'required|min:3|max:255',
            'contact_person' => 'required|min:3|max:255',
            'website' => 'sometimes|min:3|max:255',
            'bank_info' => 'sometimes|min:3|max:255',
            'status' => 'sometimes|in:active,inactive',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            $this->errorResponse("Validation error", $validator->errors(), 422)
        );
    }
}
