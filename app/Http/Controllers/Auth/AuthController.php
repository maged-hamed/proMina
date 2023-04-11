<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if ($request->post()) {
            $validate = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);
            if (Auth::attempt($validate)) {
                return redirect()->intended('admin/album');
            }
        } else {
            return view('admin.login');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }
}
