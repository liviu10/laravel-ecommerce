<?php

namespace App\Http\Requests\Admin\Configurations;

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
            'county_id'       => 'required',
            'siruta_code'     => 'required|max:255',
            'name'            => 'required|max:255',
            'longitude'       => 'required|max:255',
            'latitude'        => 'required|max:255',
            'google_maps_url' => 'required|max:255'
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'county_id.required'       => 'Field <:attribute> is required!',
            'siruta_code.required'     => 'Field <:attribute> is required!',
            'siruta_code.max'          => 'Field <:attribute> must not exceed :max characters!',
            'name.required'            => 'Field <:attribute> is required!',
            'name.max'                 => 'Field <:attribute> must not exceed :max characters!',
            'longitude.required'       => 'Field <:attribute> is required!',
            'longitude.max'            => 'Field <:attribute> must not exceed :max characters!',
            'latitude.required'        => 'Field <:attribute> is required!',
            'latitude.max'             => 'Field <:attribute> must not exceed :max characters!',
            'google_maps_url.required' => 'Field <:attribute> is required!',
            'google_maps_url.max'      => 'Field <:attribute> must not exceed :max characters!',
        ];
    }
}
