<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Students\AddTeacherRatingRequest;
use App\Models\AppointmentRating;
use App\Models\BookAppointment;

class AppointmentRatingsController extends Controller
{
    /********* Initialize Permission based Middlewares  ***********/
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function addAppointmentRating(AddTeacherRatingRequest $request)
    {
        $user = auth()->user();
        $student = $user->student;

        $appointment = BookAppointment::where('id', $request->booked_appointment_id)->first();
        $logged_in_as = $request->session()->get('logged_in_as');
        if ($logged_in_as == 'student') {
            if ($appointment->student_id != $student->id) {
                request()->session()->flash('alert', [
                    'type' => 'error',
                    'message' => 'not authenticated',
                ]);
                return redirect()->route('appointment_log');
            }
            $fromable_id = $student->id;
            $fromable_type = 'App\Models\Student';
            if ($appointment->teacher_id) {
                $to_id = $appointment->teacher_id;
                $to_type = 'App\Models\Teacher';
            }
            if ($appointment->academy_id) {
                $to_id = $appointment->academy_id;
                $to_type = 'App\Models\Academy';
            }
        } else {
            if ($logged_in_as == 'teacher') {
                $teacher = $user->teacher;
                if ($appointment->teacher_id != $teacher->id) {
                    request()->session()->flash('alert', [
                        'type' => 'error',
                        'message' => 'not authenticated',
                    ]);
                    return redirect()->route('appointment_log');
                }

                $fromable_id = $teacher->id;
                $fromable_type = 'App\Models\Teacher';
            }
            if ($logged_in_as == 'academy') {
                $academy = $user->academy;
                if ($appointment->academy_id != $academy->id) {
                    request()->session()->flash('alert', [
                        'type' => 'error',
                        'message' => 'not authenticated',
                    ]);
                    return redirect()->route('appointment_log');
                }
                $fromable_id = $academy->id;
                $fromable_type = 'App\Models\Academy';
            }
            $to_id = $appointment->student_id;
            $to_type = 'App\Models\Student';
        }
        $data['fromable_id'] = $fromable_id;
        $data['fromable_type'] = $fromable_type;
        $data['to_id'] = $to_id;
        $data['to_type'] = $to_type;
        $data['booked_appointment_id'] = $request->booked_appointment_id;
        $data['comment'] = $request->comment;
        $data['rating'] = $request->rating;
        AppointmentRating::create($data);
        request()->session()->flash('alert', [
            'type' => 'success',
            'message' => 'Rating Added Successfully',
        ]);
        return redirect()->back()->withResponseData([
            'message' => 'Rating Added Successfully',
            'type' => 'success'
        ]);
    }
}
