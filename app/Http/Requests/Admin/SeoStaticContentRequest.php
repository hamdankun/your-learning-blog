<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SeoStaticContentRequest extends FormRequest
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
            'home' => 'required',
            'home' => 'required',
            'home' => 'required',
            'site_map' => 'required',
            'site_map' => 'required',
            'site_map' => 'required',
            'privacy_police' => 'required',
            'privacy_police' => 'required',
            'privacy_police' => 'required',
            'contact_us' => 'required',
            'contact_us' => 'required',
            'contact_us' => 'required',
            'about_us' => 'required',
            'about_us' => 'required',
            'about_us' => 'required',
            'home.attribute_key.*' => 'required',
            'home.attribute_name.*' => 'required',
            'home.attribute_content.*' => 'required',
            'site_map.attribute_key.*' => 'required',
            'site_map.attribute_name.*' => 'required',
            'site_map.attribute_content.*' => 'required',
            'privacy_police.attribute_key.*' => 'required',
            'privacy_police.attribute_name.*' => 'required',
            'privacy_police.attribute_content.*' => 'required',
            'contact_us.attribute_key.*' => 'required',
            'contact_us.attribute_name.*' => 'required',
            'contact_us.attribute_content.*' => 'required',
            'about_us.attribute_key.*' => 'required',
            'about_us.attribute_name.*' => 'required',
            'about_us.attribute_content.*' => 'required',
        ];
    }
}
