<?php

namespace App\Http\Requests\Admin\Files;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'code'                   => 'required|max:10|regex:/^[A-Z0-9]+$/|unique:products',
            'name'                   => 'required|max:255',
            'unit_of_measurement_id' => 'required',
            'vat_type_id'            => 'required',
            'product_type_id'        => 'required',
            'sales_price'            => 'required|regex:/^[0-9]+$/',
            'sales_price_with_vat'   => 'required|regex:/^[0-9]+$/',
            'barcode'                => 'required|max:13|unique:products',
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
            'code.required'                   => 'Field <:attribute> is required!',
            'code.max'                        => 'Field <:attribute> must not exceed :max characters!',
            'code.regex'                      => 'Field <:attribute> must contain only numbers and capitalized letters without any special characters!',
            'code.unique'                     => 'Field <:attribute> must be a unique value!',
            'name.required'                   => 'Field <:attribute> is required!',
            'name.max'                        => 'Field <:attribute> must not exceed :max characters!',
            'unit_of_measurement_id.required' => 'Field <:attribute> is required!',
            'vat_type_id.required'            => 'Field <:attribute> is required!',
            'product_type_id.required'        => 'Field <:attribute> is required!',
            'sales_price.required'            => 'Field <:attribute> is required!',
            'sales_price.regex'               => 'Field <:attribute> must contain only numbers with 4 digits and without any special characters!',
            'sales_price_with_vat.required'   => 'Field <:attribute> is required!',
            'sales_price_with_vat.regex'      => 'Field <:attribute> must contain only numbers with 4 digits and without any special characters!',
            'barcode.required'                => 'Field <:attribute> is required!',
            'barcode.max'                     => 'Field <:attribute> must not exceed :max characters!',
            'barcode.unique'                  => 'Field <:attribute> must be a unique value!',
        ];
    }
}
