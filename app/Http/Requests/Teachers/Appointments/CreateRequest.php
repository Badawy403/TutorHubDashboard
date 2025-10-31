<?php

namespace App\Http\Requests\Teachers\Appointments;

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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'selected_days' => 'required_if:appointment_type,video,audio|array',
            'start_time' => 'nullable|string',
            'end_time' => 'nullable|string',
            'fee' => 'required_if:is_schedule_required,1',
            'interval' => 'nullable|integer',
            'generated_slots' => 'required_if:appointment_type,video,audio',
            'appointment_type_id' => 'required|integer',
            'is_schedule_required' => 'required',
        ];
    }
}
