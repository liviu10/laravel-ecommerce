<?php

namespace App\Http\Requests\Admin\Configurations;

use Illuminate\Foundation\Http\FormRequest;

class CountyRequest extends FormRequest
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
            'country_id' => 'required',
            'name'       => 'required|max:255',
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
            'country_id.required' => 'Field <:attribute> is required!',
            'name.required'       => 'Field <:attribute> is required!',
            'name.max'            => 'Field <:attribute> must not exceed :max characters!',
        ];
    }
}
