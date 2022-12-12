<?php

namespace App\Http\Requests\Admin\Files;

use Illuminate\Foundation\Http\FormRequest;

class AccountRequest extends FormRequest
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
            'account_type_id' => 'required',
            'code'            => 'required|max:36|regex:/^[A-Z0-9]+[.]+[A-Z0-9]+$/|unique:accounts',
            'name'            => 'required|max:255',
            'is_active'       => 'required'
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
            'account_type_id.required' => 'Field <:attribute> is required!',
            'code.required'            => 'Field <:attribute> is required!',
            'code.max'                 => 'Field <:attribute> must not exceed :max characters!',
            'code.regex'               => 'Field <:attribute> must contain only numbers and capitalized letters without any special characters!',
            'code.unique'              => 'Field <:attribute> must be a unique value!',
            'name.required'            => 'Field <:attribute> is required!',
            'name.max'                 => 'Field <:attribute> must not exceed :max characters!',
            'is_required.required'     => 'Field <:attribute> is required!',
        ];
    }
}
