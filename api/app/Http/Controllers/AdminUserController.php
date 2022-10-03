<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{

    function __construct()
    {
        $this->middleware('auth');
    }

    public function createChangePassword($id)
    {
        $user = User::find($id);
        return view(
            'admin.change_password',
            [
                'user' => $user
            ]
        );
    }

    public function updateChangePassword(Request $request, $id)
    {
        $user = User::find($id);

        $this->validate($request, [
            'password' => 'required',
            'new_password' => [
                'same:confirm-password',
                'min:8',
                'max:20',
            ],
        ]);
        $input = $request->all();
        if (Hash::check($request->input('password'), $user->password)) {
            $input['password'] = Hash::make($input['new_password']);
            $user->update($input);

            Auth::logout();

            return redirect()->route('login')
        ->with('success', 'Password updated successfully, Please login with new password');
            
        }
        else
        {
            return back()->with('error', 'Your password is incorrect');
        }

    }
}
