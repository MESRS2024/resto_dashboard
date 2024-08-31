<?php

namespace App\Http\Requests;

use App\Models\Residences;
use Illuminate\Foundation\Http\FormRequest;

class UpdateResidencesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = Residences::$rules;
        
        return $rules;
    }
}
