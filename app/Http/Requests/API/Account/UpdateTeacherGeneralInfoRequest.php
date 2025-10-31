<?php

namespace App\Http\Requests\API\Account;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTeacherGeneralInfoRequest extends FormRequest
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
        $teacher = $user->teacher;
        return [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'description' => 'required|string',
            'address_line_1' => 'required|string',
            'address_line_2' => 'nullable|string',
            'user_name' => 'required|alpha_dash|unique:teachers,user_name,'.$teacher->id,
            'country_id' => 'nullable|exists:countries,id',
            'state_id' => 'nullable|required_with:country_id|exists:states,id',
            'city_id' => 'nullable|required_with:country_id|exists:cities,id',
            'zip_code' => 'required|string',
            'languages' => 'required|array',
            'tags' => 'required|array',
            'teacher_categories' => 'required|array',
            'speciality' => 'nullable|string',
            'home_phone' => 'nullable|string',
            'cell_phone' => 'nullable|string',
            'job_title' => 'nullable|string',
            'website' => 'nullable|string',
            'company' => 'nullable|string',
            'email' => 'nullable|unique:teachers,email,'.$teacher->id,
            'work_country_id' => 'nullable|exists:countries,id',
            'work_state_id' => 'nullable|required_with:work_country_id|exists:states,id',
            'work_city_id' => 'nullable|required_with:work_country_id|exists:cities,id',
            'work_address_line_1' => 'nullable|string',
            'work_address_line_2' => 'nullable|string',
            'work_zip_code' => 'nullable|string',
            'shipping_country_id' => 'nullable|exists:countries,id',
            'shipping_state_id' => 'nullable|required_with:shipping_country_id|exists:states,id',
            'shipping_city_id' => 'nullable|required_with:shipping_country_id|exists:cities,id',
            'shipping_address_line_1' => 'nullable|string',
            'shipping_address_line_2' => 'nullable|string',
            'shipping_zip_code' => 'nullable|string',
            'billing_country_id' => 'nullable|exists:countries,id',
            'billing_state_id' => 'nullable|required_with:billing_country_id|exists:states,id',
            'billing_city_id' => 'nullable|required_with:billing_country_id|exists:cities,id',
            'billing_address_line_1' => 'nullable|string',
            'billing_address_line_2' => 'nullable|string',
            'billing_zip_code' => 'nullable|string',

            
        ];
    }
}
