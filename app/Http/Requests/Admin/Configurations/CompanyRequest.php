<?php

namespace App\Http\Requests\Admin\Configurations;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
            'list_of_economic_activities_id' => 'required',
            'name'                           => 'required|max:255',
            'fiscal_code'                    => 'required|max:12|regex:/^[A-Z0-9]+$/|unique:companies',
            'registration_number'            => 'required|max:20|regex:/^[A-Z0-9\/]+$/|unique:companies',
            'social_capital'                 => 'required|regex:/^[0-9]+$/',
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
            'list_of_economic_activities_id.required' => 'Field <:attribute> is required!',
            'name.required'                           => 'Field <:attribute> is required!',
            'name.max'                                => 'Field <:attribute> must not exceed :max characters!',
            'fiscal_code.required'                    => 'Field <:attribute> is required!',
            'fiscal_code.max'                         => 'Field <:attribute> must not exceed :max characters!',
            'fiscal_code.regex'                       => 'Field <:attribute> must contain only lower letters and numbers without any special characters!',
            'fiscal_code.unique'                      => 'Field <:attribute> must be a unique value!',
            'registration_number.required'            => 'Field <:attribute> is required!',
            'registration_number.max'                 => 'Field <:attribute> must not exceed :max characters!',
            'registration_number.regex'               => 'Field <:attribute> must contain only lower letters and numbers without any special characters!',
            'registration_number.unique'              => 'Field <:attribute> must be a unique value!',
            'social_capital.required'                 => 'Field <:attribute> is required!',
            'social_capital.regex'                    => 'Field <:attribute> must be a number with a maximum of four decimals!',
        ];
    }
}
