<?php

namespace App\Http\Requests\Users\Contacts;

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

    /**
     * @return string[]
     */
    public function messages()
    {
        return  [
                'name' => 'Das Namensfeld ist erforderlich.',
                'email' => 'Das E-Mail-Feld ist erforderlich.',
                'description' => 'Das Beschreibungsfeld ist erforderlich.'
            ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'email' => 'required|email',
            'description' => 'required|string',
        ];
    }
}
