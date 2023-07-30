<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function update_profile_info(Request $request)
    {
        $user = User::where('id', Auth::user()->id)->firstOrFail();

        if($user->email === $request->email) {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'phone' => 'required',
                'status' => 'required'
            ]);
        } else {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'phone' => 'required',
                'status' => 'required',
            ]);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;

        $user->save();

        return redirect()->route('dashboard')->with('success', 'Profile Information Updated Successfully');
       
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

    function destroy(Request $request) {
        $user = User::where('id', $request->id)->firstOrFail();

        $user->delete();
    }

    
}
