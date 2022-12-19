<?php

namespace App\Http\Requests\Admin\Connect;

use Illuminate\Foundation\Http\FormRequest;

class NewsletterCampaignRequest extends FormRequest
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
            'campaign_name'        => 'required|max:255',
            'campaign_description' => 'required|max:255',
            'campaign_is_active'   => 'required',
            'valid_from'           => 'required',
            'valid_to'             => 'required',
            'occur_times'          => 'required',
            'occur_week'           => 'required',
            'occur_day'            => 'required',
            'occur_hour'           => 'required',
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
            'campaign_name.required'        => 'Field <:attribute> is required!',
            'campaign_name.max'             => 'Field <:attribute> must not exceed :max characters!',
            'campaign_description.required' => 'Field <:attribute> is required!',
            'campaign_description.max'      => 'Field <:attribute> must not exceed :max characters!',
            'campaign_is_active.required'   => 'Field <:attribute> is required!',
            'valid_from.required'           => 'Field <:attribute> is required!',
            'valid_to.required'             => 'Field <:attribute> is required!',
            'occur_week.required'           => 'Field <:attribute> is required!',
            'occur_day.required'            => 'Field <:attribute> is required!',
            'occur_hour.required'           => 'Field <:attribute> is required!',
        ];
    }
}
