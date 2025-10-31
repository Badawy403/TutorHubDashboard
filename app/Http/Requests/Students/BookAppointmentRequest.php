<?php

namespace App\Http\Requests\Students;

use Illuminate\Foundation\Http\FormRequest;

class BookAppointmentRequest extends FormRequest
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
            // 'question' => 'required',
            'date' => 'required',
            // 'healer_id' => 'required|integer',
            'appointment_type_id' => 'required|integer',
            'selected_schedule_id' => 'required_if:appointment_type_id,1,2',
        ];
    }
}
