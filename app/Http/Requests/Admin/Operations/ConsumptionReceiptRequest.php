<?php

namespace App\Http\Requests\Admin\Operations;

use Illuminate\Foundation\Http\FormRequest;

class ConsumptionReceiptRequest extends FormRequest
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
            'document_type_id'      => 'required',
            'document_number'       => 'required|max:23|regex:/^([A-Z]{1,3})+(_)+([0-9]{10})+(_)+([0-9]{8})$/|unique:cash_and_bank_register',
            'document_date'         => 'required',
            'warehouse_type_id'     => 'required',
            'invoice_id'            => 'required',
            'gross_value'           => 'required|regex:/^[0-9]*\.[0-9]{4}$/',
            'vat_type_id'           => 'required',
            'net_value'             => 'required|regex:/^[0-9]*\.[0-9]{4}$/',
            'document_explications' => 'required|max:255',
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
            'document_type_id.required'     => 'Field <:attribute> is required!',
            'document_number.required'      => 'Field <:attribute> is required!',
            'document_number.max'           => 'Field <:attribute> must not exceed :max characters!',
            'document_number.regex'         => 'Field <:attribute> must contain only capitalized letters and numbers without any special characters!',
            'document_number.unique'        => 'Field <:attribute> must be a unique value!',
            'document_date.required'        => 'Field <:attribute> is required!',
            'warehouse_type_id.required'    => 'Field <:attribute> is required!',
            'invoice_id.required'           => 'Field <:attribute> is required!',
            'gross_value.required'          => 'Field <:attribute> is required!',
            'gross_value.regex'             => 'Field <:attribute> must be a number with a maximum of four decimals!',
            'vat_type_id.required'          => 'Field <:attribute> is required!',
            'net_value.required'            => 'Field <:attribute> is required!',
            'net_value.regex'               => 'Field <:attribute> must be a number with a maximum of four decimals!',
            'document_explication.required' => 'Field <:attribute> is required!',
            'document_explication.max'      => 'Field <:attribute> must not exceed :max characters!',
        ];
    }
}
