<?php

namespace App\Http\Requests\Admin\Connect;

use Illuminate\Foundation\Http\FormRequest;

class NewsletterSubscriberRequest extends FormRequest
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
            'newsletter_campaign_id' => 'required',
            'full_name'              => 'required|max:255',
            'email_address'          => 'required|max:255|unique:newsletter_subscribers',
            'privacy_policy'         => 'required',
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
            'newsletter_campaign_id.required' => 'Field <:attribute> is required!',
            'full_name.required'              => 'Field <:attribute> is required!',
            'full_name.max'                   => 'Field <:attribute> must not exceed :max characters!',
            'email_address.required'          => 'Field <:attribute> is required!',
            'email_address.max'               => 'Field <:attribute> must not exceed :max characters!',
            'email_address.unique'            => 'Field <:attribute> must be a unique value!',
            'privacy_policy.required'         => 'Field <:attribute> is required!',
        ];
    }
}
