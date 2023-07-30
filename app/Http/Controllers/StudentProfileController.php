<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StudentProfileController extends Controller
{
    function edit() {
        $student = Student::where('email', Auth::user()->email)->firstOrFail();
        return view('profile.student_profile', compact('student'));
    }

    function update_profile_info(Request $request) {
        $student = Student::where('email', Auth::user()->email)->firstOrFail();
        $user = User::where('id', Auth::user()->id)->firstOrFail();

        if($student->email === $request->email) {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'phone' => 'required'
            ]);
        } else {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'phone' => 'required'
            ]);
        }

        $student->name = $request->name;
        $student->email = $request->email;
        $student->phone = $request->phone;

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;

        $student->save();
        $user->save();

        return redirect()->route('student.dashboard')->with('success', 'Profile Information Updated Successfully');

        
    }

    function update_password(Request $request) {
        $request->validate([
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password'
        ]);

        $user = User::where('id', Auth::user()->id)->firstOrFail();

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('student.dashboard')->with('success', 'Password Updated Successfully');

    }

    function image_update(Request $request) {
        $request->validate([
            'image' => 'required|mimes:png,jpg|max:2500'
        ]);

        $student = Student::where('email', Auth::user()->email)->firstOrFail();

        $student->image = ImageUpload($request->image, STUDENT_PROFILE_IMAGE);

        $student->save();

        return redirect()->route('student.dashboard')->with('success', 'Profile Image Updated Successfully');

    }
}
