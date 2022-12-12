<?php

namespace App\Http\Requests\Admin\Configurations;

use Illuminate\Foundation\Http\FormRequest;

class CompanyDetailsRequest extends FormRequest
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
            'company_id'    => 'required',
            'country_id'    => 'required',
            'county_id'     => 'required',
            'city_id'       => 'required',
            'address'       => 'required|max:255',
            'bank_name'     => 'required|max:255',
            'bank_account'  => 'required|max:32|regex:/^[A-Z0-9]+$/',
            'phone'         => 'required|max:10|regex:/^(\+\d{1,3}[- ]?)?\d{10}$/',
            'email_address' => 'required|max:255',
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
            'company_id.required'    => 'Field <:attribute> is required!',
            'country_id.required'    => 'Field <:attribute> is required!',
            'county_id.required'     => 'Field <:attribute> is required!',
            'city_id.required'       => 'Field <:attribute> is required!',
            'address.required'       => 'Field <:attribute> is required!',
            'address.max'            => 'Field <:attribute> must not exceed :max characters!',
            'bank_name.required'     => 'Field <:attribute> is required!',
            'bank_name.max'          => 'Field <:attribute> must not exceed :max characters!',
            'bank_account.required'  => 'Field <:attribute> is required!',
            'bank_account.max'       => 'Field <:attribute> must not exceed :max characters!',
            'bank_account.regex'     => 'Field <:attribute> must contain only lower letters and numbers without any special characters!',
            'phone.required'         => 'Field <:attribute> is required!',
            'phone.max'              => 'Field <:attribute> must not exceed :max characters!',
            'phone.regex'            => 'Field <:attribute> is not a valid phone number!',
            'email_address.required' => 'Field <:attribute> is required!',
            'email_address.max'      => 'Field <:attribute> must not exceed :max characters!',
        ];
    }
}
