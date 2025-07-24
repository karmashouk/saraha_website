<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showAuth()
    {
        return view('index.auth');
    }


    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('home'); // ✅ بعد تسجيل الدخول يروح لصفحة صارحني
        }

        return back()->withErrors(['email' => 'بيانات الدخول غير صحيحة']);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        Auth::login($user); // ✅ تسجيل دخول تلقائي بعد التسجيل

        return redirect()->route('home'); // ✅ يروح على صفحة صارحني بعد التسجيل
    }
}
