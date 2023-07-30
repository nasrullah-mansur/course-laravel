<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    function student_attendance(Request $request) {
                
        $user_email = Auth::user()->email;

        $student = Student::where('email', $user_email)->firstOrFail();

        $class_no_request = $request->class_no;
        $attendance_request = $request->attendance;
        $student_attendance = $student->attendance ? json_decode($student->attendance) : [];
        $student_absent = $student->absent ? json_decode($student->absent) : [];

        if($attendance_request === 'p') {
           if(!in_array($class_no_request, $student_attendance)) {
            array_push($student_attendance, $class_no_request);
           }

            // Check if the value is found and remove it
            $key = array_search($class_no_request, $student_absent);
            if ($key !== false) {
                unset($student_absent[$key]);
                $student_absent = array_values($student_absent);
            }
        } else {
            // Absent handler;
            if(!in_array($class_no_request, $student_absent)) {
                array_push($student_absent, $class_no_request);
            }

            // Check if the value is found and remove it
            $key = array_search($class_no_request, $student_attendance);
            if ($key !== false) {
                unset($student_attendance[$key]);
                $student_attendance = array_values($student_attendance);
            }
        }


        $student->attendance = json_encode($student_attendance);
        $student->absent = json_encode($student_absent);
        
        $student->save();
        

        return redirect()->route('student.dashboard')->with('success', 'Thank you for your attendance');

    }

    function student_attendance_by_admin(Request $request) {
        $student = Student::where('id', $request->student_id)->firstOrFail();
              
        $class_no_request = $request->class_no;
        $attendance_request = $request->attendance;
        $student_attendance = $student->attendance ? json_decode($student->attendance) : [];
        $student_absent = $student->absent ? json_decode($student->absent) : [];

        if($attendance_request === 'p') {
           if(!in_array($class_no_request, $student_attendance)) {
            array_push($student_attendance, $class_no_request);
           }

            // Check if the value is found and remove it
            $key = array_search($class_no_request, $student_absent);
            if ($key !== false) {
                unset($student_absent[$key]);
                $student_absent = array_values($student_absent);
            }
        } else {
            // Absent handler;
            if(!in_array($class_no_request, $student_absent)) {
                array_push($student_absent, $class_no_request);
            }

            // Check if the value is found and remove it
            $key = array_search($class_no_request, $student_attendance);
            if ($key !== false) {
                unset($student_attendance[$key]);
                $student_attendance = array_values($student_attendance);
            }
        }


        $student->attendance = json_encode($student_attendance);
        $student->absent = json_encode($student_absent);
        
        $student->save();
        
        return redirect()->back()->with('success', 'Attendance changed successfully');
    }
}
