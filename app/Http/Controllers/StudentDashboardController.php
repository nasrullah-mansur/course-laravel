<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\DClass;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentDashboardController extends Controller
{
    function dashboard() {
        $student = Student::where('email', Auth::user()->email)
        ->firstOrFail();

        
        $batch = Batch::where('id', $student->batch_id)->firstOrFail();
        $completed_classes = DClass::where('batch_id', $batch->id)
        ->where('status', CLASS_END)
        ->get()
        ->count();

        $running_class = DClass::where('batch_id', $batch->id)
        ->where('status', CLASS_START)
        ->orderBy('created_at', 'DESC')
        ->first();

        // Today attendance handler start;
        $attendance_done = false;

        if($running_class) {
            $student_attendances_exist = in_array($running_class->id, json_decode($student->attendance) ?? []);
            $student_absent_exist = in_array($running_class->id, json_decode($student->absent) ?? []);

            if($student_attendances_exist || $student_absent_exist) {
                $attendance_done = true;
            }

        } else {
            $attendance_done = true;
        }
        // Today attendance handler end;

        // Total present & absent handler start;
        $student_present_count = 0;
        if($student->attendance != null) {
            $student_present_count = count(json_decode($student->attendance));
        }

        $running_classes_count = DClass::where('batch_id', $batch->id)
        ->where('status', CLASS_START)
        ->get()
        ->count();

        $student_absent_count = ($completed_classes - $student_present_count) + $running_classes_count;
        // Total present & absent handler end;





        return view('front.student_dashboard.dashboard', compact(
            'student', 
            'batch', 
            'completed_classes', 
            'running_class', 
            'attendance_done',
            'student_present_count',
            'student_absent_count',
            'completed_classes'
        ));
    }
}
