<?php

namespace App\Http\Requests\Account;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAcademyGeneralInfoRequest extends FormRequest
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
     * @return string[]
     */
    public function messages()
    {
        return [
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $user= auth()->user();
        $academy = $user->academy;
        $allLanguages = allLanguages();
        $allRules = [];
        foreach ($allLanguages as $language){
            $allRules['description.'.$language->code] = 'nullable|string';
          }
        $allRules['first_name'] = 'required|string';
        $allRules['last_name'] = 'required|string';
        $allRules['academy_name'] = 'required|string';
        $allRules['address_line_1'] = 'required|string';
        $allRules['address_line_2'] = 'required|string';
        $allRules['academy_website'] = 'nullable|url';
        $allRules['user_name'] = 'required|alpha_dash|max:55|unique:academies,user_name,'.$academy->id;
        $allRules['zip_code'] = 'required|string';
        return $allRules;
    }
}
