<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function index() {
        $admins = User::where('role', ROLE_ADMIN)
        ->get();

        return view('back.user.index', compact('admins'));
    }

    function create() {
        return view('back.user.create');
    }

    function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'email|required|unique:users',
            'phone' => 'required',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->status = $request->status;
        $user->password = 'password';

        $user->role = ROLE_ADMIN;

        $user->save();

        return redirect()->route('admins')->with('success', 'New Admin Added');
    }

    function edit($id) {
        $user = User::where('id', $id)->firstOrFail();
        return view('back.user.edit', compact('user'));
    }

    function update(Request $request, $id) {
        $user = User::where('id', $id)->firstOrFail();

        if($user->email === $request->email) {
            $request->validate([
                'name' => 'required',
                'email' => 'email|required',
                'phone' => 'required',
            ]);
        } else {
            $request->validate([
                'name' => 'required',
                'email' => 'email|required|unique:users',
                'phone' => 'required',
            ]);
        }


        
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->status = $request->status;
        $user->password = 'password';

        $user->role = ROLE_ADMIN;

        $user->save();

        return redirect()->route('admins')->with('success', 'Admin Info Updated');
    }

    function inactive_user() {
       return view('inactive_user');
    }

}
