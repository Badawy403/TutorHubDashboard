<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Models\AppointmentStatus;
use App\Models\BookAppointment;
use App\Models\Student;
use App\Models\Event;
use App\Models\Academy;
use App\Models\Teacher;

class HomeController extends Controller
{
    public function __construct()
    {
    }

    public function home(Request $request)
    {
        $totalUsers = Student::count();
        $totalTeachers = Teacher::has('user')->whereNotNull('user_name')->active()->approved()->count();
        $totalAcademy = Academy::active()->approved()->count();
        $totalEvents = Event::active()->approved()->upcoming()->count();
        $totalAppointments = BookAppointment::where('appointment_status_code',AppointmentStatus::$Completed)->count();
        $data = [
            'total_users' => $totalUsers,
            'total_teachers' => $totalTeachers,
            'total_law_frims' => $totalAcademy,
            'total_events' => $totalEvents,
            'total_subscriptions' => $totalUsers,
            'total_appointments' => $totalAppointments,
        ];
        return Inertia::render('Home',['dashboard_data' => $data]);
    }
}
