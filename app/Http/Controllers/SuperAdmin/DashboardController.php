<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\BookAppointment;
use App\Models\Academy;
use App\Models\Teacher;
use App\Models\User;
use App\Models\Student;
use App\Models\Event;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function home(Request $request)
    {
        $totalTeachers = Teacher::count();
        $totalAcademies = Academy::count();
        $totalBookedAppointments = BookAppointment::count();
        $totalUsers = Student::count();
        $totalBlogCategories = 15;
        $totalSubscriptions = DB::table('subscriptions')->count();
        $totalEvents = Event::count();
        $totalLowProfileTeachers = 0;
        $allTeacher = Teacher::has('teacher_reviews')->get();

        foreach ($allTeacher as $key => $teacher) {
            $rating = $teacher->teacher_reviews()->avg('rating');
            if (!empty($rating) && $rating < 2) {
                $totalLowProfileTeachers++;
            }
        }
        $totalCompleteTeacherProfiles = User::whereHas('teacher', function ($q) {
            $q->where('profile_completion_percentage', '>=', 25);
        })->count();
        $totalCompleteAcademyProfiles = User::whereHas('academy', function ($q) {
            $q->where('profile_completion_percentage', '>=', 25);
        })->count();
        $allAcademies = Academy::has('academy_reviews')->get();
        $totalLowProfileAcademies = 0;
        foreach ($allAcademies as $key => $academy) {
            $rating = $academy->academy_reviews()->avg('rating');
            if (!empty($rating) && $rating < 2) {
                $totalLowProfileAcademies++;
            }
        }
        $recordsByMonthThisYear = DB::table('booked_appointments')
                                ->selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as count')
                                ->where('created_at', '>=', Carbon::now()->subMonths(6)->startOfMonth())
                                ->where('created_at', '<=', Carbon::now()->endOfMonth())
                                ->groupBy('year', 'month')
                                ->orderBy('year', 'asc')
                                ->orderBy('month', 'asc')
                                ->get();
                                $appointmentRecordsByMonthsKeyed = [
                                    'Total' => 0
                                ];

                                foreach ($recordsByMonthThisYear as $group) {
                                    $year = $group->year;
                                    $month = $group->month;
                                    $count = $group->count;

                                    $monthKey = Carbon::createFromDate($year, $month, 1)->format('F');

                                    $appointmentRecordsByMonthsKeyed[$monthKey] = $count;
                                    $appointmentRecordsByMonthsKeyed['Total'] = $count + $appointmentRecordsByMonthsKeyed['Total'];
                                }
                                $recordsByMonthLastYear = DB::table('booked_appointments')
                                ->selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as count')
                                ->where('created_at', '>=', Carbon::now()->subMonths(18)->startOfMonth())
                                ->where('created_at', '<=', Carbon::now()->subMonths(12))
                                ->groupBy('year', 'month')
                                ->orderBy('year', 'asc')
                                ->orderBy('month', 'asc')
                                ->get();
                                $appointmentRecordsByLasteYearMonthsKeyed = ['Total' => 0];

                                foreach ($recordsByMonthLastYear as $group) {
                                    $year = $group->year;
                                    $month = $group->month;
                                    $count = $group->count;

                                    $monthKey = Carbon::createFromDate($year, $month, 1)->format('F');

                                    $appointmentRecordsByLasteYearMonthsKeyed[$monthKey] = $count;
                                    $appointmentRecordsByLasteYearMonthsKeyed['Total'] = $count + $appointmentRecordsByMonthsKeyed['Total'];
                                }
                                $currentWeekStart = Carbon::now()->startOfWeek();
                                $currentWeekEnd = Carbon::now()->endOfWeek();
                                $lastWeekStart = Carbon::now()->subWeek()->startOfWeek()->format('Y-m-d');
                                $lastWeekEnd = Carbon::now()->subWeek()->endOfWeek()->format('Y-m-d');

                                $currentWeekStudents = DB::table('students')
                                    ->selectRaw('DAYOFWEEK(created_at) as day, COUNT(*) as count')
                                    ->whereBetween('created_at', [$currentWeekStart, $currentWeekEnd])
                                    ->groupBy('day')
                                    ->orderBy('day')
                                    ->get();
                                    $tempCurrentWeekStudents = [];
                                    foreach ($currentWeekStudents as $group) {
                                        $day = $group->day . 'th';
                                        $count = $group->count;
                                        $tempCurrentWeekStudents[$day] = $count;
                                    }
                                    $lastWeekStudents = DB::table('students')
                                    ->selectRaw('DAYOFWEEK(created_at) as day, COUNT(*) as count')
                                    ->whereBetween('created_at', [$lastWeekStart, $lastWeekEnd])
                                    ->groupBy('day')
                                    ->orderBy('day')
                                    ->get();
                                    $templastWeekStudents = [];
                                    foreach ($lastWeekStudents as $group) {
                                        $day = $group->day . 'th';
                                        $count = $group->count;
                                        $templastWeekStudents[$day] = $count;
                                    }

        $data = [
            'totalUsers' => $totalUsers,
            'totalBookedAppointments' => $totalBookedAppointments,
            'totalBlogCategories' => $totalBlogCategories,
            'totalSubscriptions' => $totalSubscriptions,
            'totalTeachers' => $totalTeachers,
            'total_academies' => $totalAcademies,
            'total_subscriptions' => $totalUsers,
            'totalLowProfileTeachers' => $totalLowProfileTeachers,
            'totalCompleteTeacherProfiles' => $totalCompleteTeacherProfiles,
            'totalCompleteAcademyProfiles' => $totalCompleteAcademyProfiles,
            'totalLowProfileUsers' => $totalLowProfileTeachers + $totalLowProfileAcademies + $totalLowProfileAcademies + $totalCompleteAcademyProfiles,
            'totalLowProfileAcademies' => $totalLowProfileAcademies,
            'appointmentRecordsByMonthsKeyed' => $appointmentRecordsByMonthsKeyed,
            'appointmentRecordsByLasteYearMonthsKeyed' => $appointmentRecordsByLasteYearMonthsKeyed,
            'currentWeekStudents' => $tempCurrentWeekStudents,
            'lastWeekStudents' => $templastWeekStudents,
            'totalEvents' => $totalEvents,
        ];

        return view('super_admins.dashboard', compact('data'));
    }

    public function viewNotification(Request $request, $type)
    {
        if ($type == 'low_profile_teachers') {
            /********* Get Low Profile Teachers  **********/
            $allTeachers = Teacher::has('teacher_reviews')->get();
            $teacher_ids = [];
            foreach ($allTeachers as $key => $teacher) {
                $rating = $teacher->teacher_reviews()->avg('rating');
                if (!empty($rating) && $rating < 2) {
                    $teacher_ids[] = $teacher->id;
                }
            }
            $teachers = Teacher::whereIn('id', $teacher_ids)->get();
            return view('super_admins.view_notifications_teachers.index')->with('teachers', $teachers);
        } else if ($type == 'low_profile_academies') {
            /********* Get Low Profile Academies  **********/
            $allAcademies = Academy::has('academy_reviews')->get();
            $academy_ids = [];
            foreach ($allAcademies as $key => $academy) {
                $rating = $academy->academy_reviews()->avg('rating');
                if (!empty($rating) && $rating < 2) {
                    $academy_ids[] = $academy->id;
                }
            }
            $academies = Academy::whereIn('id', $academy_ids)->get();
            return view('super_admins.view_notifications_academies.index')->with('academies', $academies);

        } else if ($type == 'completed_teacher_profiles') {
            /********* Get completed_teacher_profiles  **********/
            $teachers = Teacher::where('profile_completion_percentage', '>=', 25)->get();
            return view('super_admins.view_notifications_teachers.index')->with('teachers', $teachers);
        } else if ($type == 'completed_academy_profiles') {
            /********* Get completed_academy_profiles  **********/
            $academies = Academy::where('profile_completion_percentage', '>=', 25)->get();
            return view('super_admins.view_notifications_academies.index')->with('academies', $academies);
        }

    }
}
