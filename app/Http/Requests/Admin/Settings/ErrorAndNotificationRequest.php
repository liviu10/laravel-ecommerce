<?php

namespace App\Http\Requests\Admin\Settings;

use Illuminate\Foundation\Http\FormRequest;

class ErrorAndNotificationRequest extends FormRequest
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
            'notify_code'              => 'required|max:10|regex:/^[A-Z0-9_]+$/|unique:errors_and_notifications',
            'notify_short_description' => 'required|max:255',
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
            'notify_code.required'              => 'Field <:attribute> is required!',
            'notify_code.max'                   => 'Field <:attribute> must not exceed :max characters!',
            'notify_code.regex'                 => 'Field <:attribute> must contain only lower letters and no special characters!',
            'notify_code.unique'                => 'Field <:attribute> must be a unique value!',
            'notify_short_description.required' => 'Field <:attribute> is required!',
            'notify_short_description.max'      => 'Field <:attribute> must not exceed :max characters!',
        ];
    }
}
