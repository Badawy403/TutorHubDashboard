<?php

namespace App\Http\Requests\API\Teachers\Appointments;

use Illuminate\Foundation\Http\FormRequest;

class AddScheduleRequest extends FormRequest
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
            'day' => 'required|string',
            'start_time' => 'required|string',
            'end_time' => 'required|string',
            'interval' => 'required|numeric|gt:0',
            'generated_slots' => 'required|array',
            'appointment_type_id' => 'required|exists:appointment_types,id',
        ];
    }
}
