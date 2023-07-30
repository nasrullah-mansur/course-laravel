<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Batch;
use App\Models\DClass;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    function find() {
        $batches = Batch::orderBy('created_at', 'DESC')->get();
        return view('back.student.find', compact('batches'));
    }

    function find_set(Request $request) {
        $batch = Batch::where('id', $request->batch_id)->firstOrFail();

        return redirect()->route('student.index', $batch->slug);
    }

    function index($slug) {

        $batch = Batch::where('slug', $slug)->firstOrFail();
        $students = Student::where('batch_id', $batch->id)->orderBy('created_at', 'DESC')->paginate(20);

        $completed_class_count = DClass::where('batch_id', $batch->id)
        ->where('status', CLASS_END)
        ->get()
        ->count();

        $running_class_count = DClass::where('batch_id', $batch->id)
        ->where('status', CLASS_START)
        ->get()
        ->count();

        return view('back.student.index', compact('batch', 'students', 'completed_class_count', 'running_class_count'));
    }

    function create() {
        
    }

    function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required'
        ]);

        $student = new Student();
        $student->name = $request->name;
        $student->email = $request->email;
        $student->phone = $request->phone;
        $student->batch_id = $request->batch_id;
        $student->status = $request->status;
        $student->save();

        // Auth create;
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->status = $request->status;
        $user->password = Hash::make('12345678');

        $user->save();

        return redirect()->route('student.index', $request->slug)->with('success', 'Student added successfully');
    }

    function edit() { // Student Front Dashboard;
        
    }

    function update() { // Student Front Dashboard;
        
    }

    function update_admin(Request $request) {

        $student = Student::where('id', $request->id)->firstOrFail();
        $user = User::where('email', $student->email)->firstOrFail();

        if($student->email != $request->email) {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'phone' => 'required'
            ]);
        } else {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'phone' => 'required'
            ]);
        }
        
        $student->name = $request->name;
        $student->email = $request->email;
        $student->phone = $request->phone;
        $student->batch_id = $request->batch_id;
        $student->status = $request->status;
       
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->status = $request->status;

        $user->save();

        $student->save();

        return redirect()->route('student.index', $request->slug)->with('success', 'Student updated successfully');
    }

    function show_info($batch_id, $student_id) {
        $batch = Batch::where('id', $batch_id)->firstOrFail();
        $student = Student::where('id', $student_id)->firstOrFail();

        $student_attendance = $student->attendance ? json_decode($student->attendance) : [];
        $d_class = DClass::where('batch_id', $batch->id)
        ->where('status', CLASS_END)
        ->orderBy('created_at', 'DESC')
        ->get();

        $running_class_count = DClass::where('batch_id', $batch->id)
        ->where('status', CLASS_START)
        ->get()
        ->count();

        return view('back.student.view', compact('student_attendance', 'd_class', 'student', 'batch', 'running_class_count'));
    }

    
}
