<?php

namespace App\Http\Requests\Admin\Connect;

use Illuminate\Foundation\Http\FormRequest;

class ContactMeResponseRequest extends FormRequest
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
            'contact_me_id'    => 'required',
            'message_response' => 'required|max:255',
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
            'contact_me_id.required'    => 'Field <:attribute> is required!',
            'message_response.required' => 'Field <:attribute> is required!',
            'message_response.max'      => 'Field <:attribute> must not exceed :max characters!',
        ];
    }
}
