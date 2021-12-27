<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CityRequest extends FormRequest
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
        return [
            'name' => 'required',
            'state_id' => 'required',
            'district_id' => 'required'
        ];
    }

    /**
     * custom error message
     */
    public function messages()
    {
        return [
            'name.required' => 'City name is required',
            'state_id.required' => 'State is required',
            'district_id.required' => 'District is required',
        ];
    }
}
