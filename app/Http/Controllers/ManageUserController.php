<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class ManageUserController extends Controller
{
    public function indexUsers()
    {
        $users = User::where('role','=','Member')->paginate(10);
        return View('manageusers.index')->with('users', $users);
    }

    public function destroyUser(User $user)
    {
        $user->delete();
        return redirect('/manageusers');
    }

    public function editUser($id)
    {
        $user = User::find($id);
        return view('manageusers.edit', compact('user'));
    }

    public function updateUser(Request $request, $id){
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

        return redirect('/manageusers');
    }
}
