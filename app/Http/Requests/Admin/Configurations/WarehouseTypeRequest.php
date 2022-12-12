<?php

namespace App\Http\Requests\Admin\Configurations;

use Illuminate\Foundation\Http\FormRequest;

class WarehouseTypeRequest extends FormRequest
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
            'code' => 'required|max:3|regex:/^[0-9]+$/|unique:warehouse_types',
            'name' => 'required|max:255',
            'type' => 'required|max:255',
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
            'code.required' => 'Field <:attribute> is required!',
            'code.max'      => 'Field <:attribute> must not exceed :max characters!',
            'code.regex'    => 'Field <:attribute> must contain only numbers without any special characters!',
            'code.unique'   => 'Field <:attribute> must be a unique value!',
            'name.required' => 'Field <:attribute> is required!',
            'name.max'      => 'Field <:attribute> must not exceed :max characters!',
            'type.required' => 'Field <:attribute> is required!',
            'type.regex'    => 'Field <:attribute> must be an integer number without any special characters!',
        ];
    }
}
