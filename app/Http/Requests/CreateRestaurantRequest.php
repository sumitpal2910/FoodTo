<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateRestaurantRequest extends FormRequest
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
            'district_id' => 'required',
            'city_id' => 'required',
            'phone' => 'required',
            'alt_phone' => '',
            'gst_no' => 'required',
            'trade_name' => 'required',
            'license_no' => 'required',
            'fssai_no' => 'required',
            'kyc' => 'required',
            'thumbnail' => 'required|image|mimes:png,jpg',
            'bg_image' => 'image|mimes:png,jpg',
            'fssai_image' => 'required',
            'license_image' => 'required',
            'address' => 'required',
            'locality' => 'required',
            'pincode' => 'required',
            'owner_name' => 'reqiured',
            'password' => 'required',
            'email' => 'required|email',
            'owner_phone' => 'required|numeric',
            'owner_alt_phone' => 'numeric',
            'owner_image' => 'image|mimes:png,jpg',
            'manager_name' => 'required',
            'manager_phone' => 'required|numeric',
            'manager_alt_phone' => 'numeric',
        ];
    }
}
