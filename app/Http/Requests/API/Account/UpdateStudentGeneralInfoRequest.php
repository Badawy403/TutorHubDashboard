<?php

namespace App\Http\Requests\API\Account;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentGeneralInfoRequest extends FormRequest
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
        $student = $user->student;
        return [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'description' => 'nullable|string',
            'address_line_1' => 'required|string',
            'address_line_2' => 'nullable|string',
            'country_id' => 'nullable|exists:countries,id',
            'state_id' => 'nullable|required_with:country_id|exists:states,id',
            'city_id' => 'nullable|required_with:country_id|exists:cities,id',
            'zip_code' => 'nullable|string',
            'user_name' => 'required|alpha_dash|unique:students,user_name,'.$student->id,

        ];
    }
}
