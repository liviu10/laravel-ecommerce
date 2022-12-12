<?php

namespace App\Http\Requests\Admin\Files;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
            'name'                => 'required|max:255',
            'fiscal_code'         => 'required|max:12|regex:/^[A-Z0-9]+$/|unique:clients',
            'registration_number' => 'required|max:20|regex:/^[A-Z0-9]+$/|unique:clients',
            'account_id'          => 'required',
            'country_id'          => 'required',
            'county_id'           => 'required',
            'city_id'             => 'required',
            'address'             => 'required|max:255',
            'bank_name'           => 'required|max:255',
            'bank_account'        => 'required|max:32|regex:/^[A-Z0-9]+$/',
            'phone'               => 'required|max:10|regex:/^(\+\d{1,3}[- ]?)?\d{10}$/',
            'email_address'       => 'required|max:255',
            'is_active'           => 'required',
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
            'name.required'                => 'Field <:attribute> is required!',
            'name.max'                     => 'Field <:attribute> must not exceed :max characters!',
            'fiscal_code.required'         => 'Field <:attribute> is required!',
            'fiscal_code.max'              => 'Field <:attribute> must not exceed :max characters!',
            'fiscal_code.regex'            => 'Field <:attribute> must contain only numbers and capitalized letters without any special characters!',
            'fiscal_code.unique'           => 'Field <:attribute> must be a unique value!',
            'registration_number.required' => 'Field <:attribute> is required!',
            'registration_number.max'      => 'Field <:attribute> must not exceed :max characters!',
            'registration_number.regex'    => 'Field <:attribute> must contain only numbers and capitalized letters without any special characters!',
            'registration_number.unique'   => 'Field <:attribute> must be a unique value!',
            'account_id.required'          => 'Field <:attribute> is required!',
            'country_id.required'          => 'Field <:attribute> is required!',
            'county_id.required'           => 'Field <:attribute> is required!',
            'city_id.required'             => 'Field <:attribute> is required!',
            'address.required'             => 'Field <:attribute> is required!',
            'address.max'                  => 'Field <:attribute> must not exceed :max characters!',
            'bank_name.required'           => 'Field <:attribute> is required!',
            'bank_name.max'                => 'Field <:attribute> must not exceed :max characters!',
            'bank_account.required'        => 'Field <:attribute> is required!',
            'bank_account.max'             => 'Field <:attribute> must not exceed :max characters!',
            'bank_account.regex'           => 'Field <:attribute> must contain only numbers and capitalized letters without any special characters!',
            'phone.required'               => 'Field <:attribute> is required!',
            'phone.max'                    => 'Field <:attribute> must not exceed :max characters!',
            'phone.regex'                  => 'Field <:attribute> must contain only numbers without any special characters!',
            'email_address.required'       => 'Field <:attribute> is required!',
            'email_address.max'            => 'Field <:attribute> must not exceed :max characters!',
            'is_active.required'           => 'Field <:attribute> is required!',
        ];
    }
}
