<?php

namespace App\Http\Requests\Teachers\TeacherServices;

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
        // dd('gleo');

        $allAttributes = [];
        $allLanguages = allLanguages();
        // Multi Lang attributes
        foreach ($allLanguages as $language) {
            $allAttributes['name.' . $language->code] = $language->name . ' Name';
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
        foreach ($allLanguages as $language){
            $allRules['name.'.$language->code] = 'required|string';
            $allRules['description.'.$language->code] = 'nullable|string';
          }
        $allRules['is_active'] = 'nullable|in:0,1';
        $allRules['price'] = 'required|numeric';

        return $allRules;
    }
}
