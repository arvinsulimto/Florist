<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.index');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, array(
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['digits_between:8,12'],
            'gender' => ['required'],
            'address' => ['required', 'min:10'],
            'profile' => 'required|image|mimes:jpeg,png,jpg',
        ));
        $users = User::findOrFail($id);
        $users->name = $request->input('name');
        $users->email = $request->input('email');
        $users->phone = $request->input('phone');
        $users->gender = $request->input('gender');
        $users->address = $request->input('address');

        if ($request->file('profile') != null) {
            $users->profile = $request->file('profile')->store('profiles', 'public');
        }
        $users->save();
        return redirect('/');
    }
}
