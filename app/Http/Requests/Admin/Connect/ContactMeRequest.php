<?php

namespace App\Http\Requests\Admin\Connect;

use Illuminate\Foundation\Http\FormRequest;

class ContactMeRequest extends FormRequest
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
            'full_name'      => 'required|max:255',
            'email_address'  => 'required|max:255',
            'subject'        => 'required|max:255',
            'message'        => 'required|max:255',
            'privacy_policy' => 'required',
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
            'full_name.required'      => 'Field <:attribute> is required!',
            'full_name.max'           => 'Field <:attribute> must not exceed :max characters!',
            'email_address.required'  => 'Field <:attribute> is required!',
            'email_address.max'       => 'Field <:attribute> must not exceed :max characters!',
            'subject.required'        => 'Field <:attribute> is required!',
            'subject.max'             => 'Field <:attribute> must not exceed :max characters!',
            'message.required'        => 'Field <:attribute> is required!',
            'message.max'             => 'Field <:attribute> must not exceed :max characters!',
            'privacy_policy.required' => 'Field <:attribute> is required!',
        ];
    }
}
