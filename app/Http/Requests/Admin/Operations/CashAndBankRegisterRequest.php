<?php

namespace App\Http\Requests\Admin\Operations;

use Illuminate\Foundation\Http\FormRequest;

class CashAndBankRegisterRequest extends FormRequest
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
            'document_date'    => 'required',
            'document_number'  => 'required|max:23|regex:/^([A-Z]{1,3})+(_)+([0-9]{10})+(_)+([0-9]{8})$/|unique:cash_and_bank_register',
            'document_note'    => 'required|max:255',
            'sum_received'     => 'required|regex:/^[0-9]+$/',
            'sum_payed'        => 'required|regex:/^[0-9]+$/',
            'is_cash_register' => 'required',
            'is_bank_register' => 'required',
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
            'document_date.required'    => 'Field <:attribute> is required!',
            'document_number.required'  => 'Field <:attribute> is required!',
            'document_number.max'       => 'Field <:attribute> must not exceed :max characters!',
            'document_number.regex'     => 'Field <:attribute> must contain only capitalized letters and numbers without any special characters!',
            'document_number.unique'    => 'Field <:attribute> must be a unique value!',
            'document_note.required'    => 'Field <:attribute> is required!',
            'document_note.max'         => 'Field <:attribute> must not exceed :max characters!',
            'sum_received.required'     => 'Field <:attribute> is required!',
            'sum_received.regex'        => 'Field <:attribute> must be a number with a maximum of four decimals!',
            'sum_payed.required'        => 'Field <:attribute> is required!',
            'sum_payed.regex'           => 'Field <:attribute> must be a number with a maximum of four decimals!',
            'is_cash_register.required' => 'Field <:attribute> is required!',
            'is_bank_register.required' => 'Field <:attribute> is required!',
        ];
    }
}
