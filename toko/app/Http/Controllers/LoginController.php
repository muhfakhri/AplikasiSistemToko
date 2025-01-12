<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class LoginController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return $this->redirectBasedOnRole();
        } else {
            return view('login');
        }
    }

    public function actionlogin(Request $request)
    {
        $credentials = [
            'name' => $request->input('name'),
            'password' => $request->input('password'),
        ];

        if (Auth::attempt($credentials)) {
            return $this->redirectBasedOnRole();
        } else {
            Session::flash('error', 'Username atau Password Salah');
            return redirect('/');
        }
    }

    public function actionlogout()
    {
        Auth::logout();
        return redirect('/');
    }

    private function redirectBasedOnRole()
    {
        $user = Auth::user();
        if ($user->role == 'admin') {
            return redirect('home');
        } elseif ($user->role == 'karyawan') {
            return redirect('karyawan');
        } else {
            Auth::logout();
            Session::flash('error', 'Role tidak dikenali');
            return redirect('/');
        }
    }
}