<?php

namespace App\Http\Requests\API\Students;

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
            'question' => 'required|string',
            'date' => 'required|date',
            'appointment_type' => 'required',
            'appointment_type_id' => 'required|exists:appointment_types,id',
            'teacher_id' => 'required_without_all:academy_id|exists:teachers,id',
            'academy_id' => 'required_without_all:teacher_id|exists:academies,id',
            'appointment_schedule_id' => 'required_if:appointment_type,video,audio|exists:appointment_schedules,id',
            //'stripe_token' => 'required|string'
        ];
    }
}
