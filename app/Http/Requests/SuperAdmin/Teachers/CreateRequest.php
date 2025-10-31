<?php

namespace App\Http\Requests\SuperAdmin\Teachers;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
    public function attributes()
    {

        $allAttributes = [];
        $allLanguages = allLanguages();
        // Multi Lang attributes
        foreach ($allLanguages as $language) {
            $allAttributes['description.' . $language->code] = $language->name . ' Description';
        }
        return $allAttributes;
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $allLanguages = allLanguages();
        $allRules = [];
        foreach ($allLanguages as $language) {
            $allRules['description.' . $language->code] = 'nullable|string';
        }
        $allRules['first_name'] = 'required|string';
        $allRules['last_name'] = 'required|string';
        $allRules['email'] = 'required|email';
        $allRules['password'] = 'required';
        $allRules['teacher_category_ids'] = 'required|array';
        $allRules['user_name'] = 'required|alpha_dash|unique:academies,user_name';
        $allRules['is_active'] = 'nullable|in:1';
        $allRules['is_featured'] = 'nullable|in:1';
        return $allRules;
    }
}
