<?php

namespace App\Http\Requests\Admin\Operations;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceLineRequest extends FormRequest
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
            'invoice_id'             => 'required',
            'product_type_id'        => 'required',
            'warehouse_type_id'      => 'required',
            'product_id'             => 'required',
            'name'                   => 'required|max:255',
            'unit_of_measurement_id' => 'required',
            'vat_type_id'            => 'required',
            'quantity'               => 'required|regex:/^[0-9]+$/|',
            'unit_gross_value'       => 'required|regex:/^[0-9]*\.[0-9]{4}$/',
            'discount'               => 'required|regex:/^[0-9]*\.[0-9]{4}$/',
            'vat_amount_value'       => 'required|regex:/^[0-9]*\.[0-9]{4}$/',
            'account_id'             => 'required',
            'unit_net_value'         => 'required|regex:/^[0-9]*\.[0-9]{4}$/',
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
            'invoice_id.required'             => 'Field <:attribute> is required!',
            'product_type_id.required'        => 'Field <:attribute> is required!',
            'warehouse_type_id.required'      => 'Field <:attribute> is required!',
            'product_id.required'             => 'Field <:attribute> is required!',
            'name.required'                   => 'Field <:attribute> is required!',
            'name.max'                        => 'Field <:attribute> must not exceed :max characters!',
            'unit_of_measurement_id.required' => 'Field <:attribute> is required!',
            'vat_type_id.required'            => 'Field <:attribute> is required!',
            'quantity.required'               => 'Field <:attribute> is required!',
            'quantity.regex'                  => 'Field <:attribute> must be a number!',
            'unit_gross_value.required'       => 'Field <:attribute> is required!',
            'unit_gross_value.regex'          => 'Field <:attribute> must be a number with a maximum of four decimals!',
            'discount.required'               => 'Field <:attribute> is required!',
            'discount.regex'                  => 'Field <:attribute> must be a number with a maximum of four decimals!',
            'vat_amount_value.required'       => 'Field <:attribute> is required!',
            'vat_amount_value.regex'          => 'Field <:attribute> must be a number with a maximum of four decimals!',
            'account_id.required'             => 'Field <:attribute> is required!',
            'unit_net_value.required'         => 'Field <:attribute> is required!',
            'unit_net_value.regex'            => 'Field <:attribute> must be a number with a maximum of four decimals!',
        ];
    }
}
