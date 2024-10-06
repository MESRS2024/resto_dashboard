<?php

namespace App\Http\Requests\FlixyRequests;

use Illuminate\Foundation\Http\FormRequest;

class FlixyByPhoneRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'phone' => 'required|string',
            'solde' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'phone.required' => 'The name field is required.',
            'phone.string' => 'The name field must be a string.',
            'solde.required' => 'The amount field is required.',
            'solde.integer' => 'The amount field must be a number.',
        ];

    }
}
