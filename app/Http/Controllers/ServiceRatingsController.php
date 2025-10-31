<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Students\AddServiceRatingRequest;
use App\Models\BookedService;
use App\Models\ServiceRating;
use App\Models\ServiceReview;

class ServiceRatingsController extends Controller
{
    /********* Initialize Permission based Middlewares  ***********/
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function addServiceRating(AddServiceRatingRequest $request)
    {

        $user = auth()->user();
        $student = $user->student;

        $service = BookedService::where('id', $request->booked_service_id)->first();
        $logged_in_as = $request->session()->get('logged_in_as');
        if ($logged_in_as == 'student') {
            if ($service->student_id != $student->id) {
                request()->session()->flash('alert', [
                    'type' => 'error',
                    'message' => 'not authenticated',
                ]);
                return redirect()->route('service_log');
            }
            $fromable_id = $student->id;
            $fromable_type = 'App\Models\Student';
            if ($service->teacher_id) {
                $to_id = $service->teacher_id;
                $to_type = 'App\Models\Teacher';
            }
            if ($service->academy_id) {
                $to_id = $service->academy_id;
                $to_type = 'App\Models\Academy';
            }
        } else {
            if ($logged_in_as == 'teacher') {
                $teacher = $user->teacher;
                if ($service->teacher_id != $teacher->id) {
                    request()->session()->flash('alert', [
                        'type' => 'error',
                        'message' => 'not authenticated',
                    ]);
                    return redirect()->route('service_log');
                }

                $fromable_id = $teacher->id;
                $fromable_type = 'App\Models\Teacher';
            }
            if ($logged_in_as == 'academy') {
                $academy = $user->academy;
                if ($service->academy_id != $academy->id) {
                    request()->session()->flash('alert', [
                        'type' => 'error',
                        'message' => 'not authenticated',
                    ]);
                    return redirect()->route('service_log');
                }
                $fromable_id = $academy->id;
                $fromable_type = 'App\Models\Academy';
            }
            $to_id = $service->student_id;
            $to_type = 'App\Models\Student';
        }
        // $data['fromable_id'] = $fromable_id;
        // $data['fromable_type'] = $fromable_type;
        $data['student_id'] = $service->student_id ?? null;
        $data['academy_id'] = $service->academy_id ?? null;
        $data['teacher_id'] = $service->teacher_id ?? null;
        // $data['to_id'] = $to_id;
        // $data['to_type'] = $to_type;
        $data['service_id'] = $service->service_id;
        $data['booked_service_id'] = $request->booked_service_id;
        $data['comment'] = $request->comment;
        $data['rating'] = $request->rating;
        ServiceReview::create($data);
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
