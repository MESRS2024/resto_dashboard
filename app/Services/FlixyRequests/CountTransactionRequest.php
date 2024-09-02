<?php

namespace App\Http\Requests\FlixyRequests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CountTransactionRequest extends FormRequest
{
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
     * @return array
     */
    public function rules(): array
    {
        return [
            'vendeure' => 'required|integer',
            'date' => 'required|date',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ]));
    }

    public function messages()
    {
        return [
            'vendeure.required' => 'The id field is required.',
            'vendeure.integer' => 'The id field must be a string.',
            'date.required' => 'The date field is required.',
            'date.integer' => 'The id field must be a date.',
        ];

    }
}
