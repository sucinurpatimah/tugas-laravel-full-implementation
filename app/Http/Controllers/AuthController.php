<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:8|confirmed',
            'role' => 'required|in:admin,user',
            'gender' => 'required|in:male,female',
            'age' => 'required|integer|min:18',
            'birth' => 'required|date',
            'address' => 'required|string|max:500',
        ]);

        if ($validator->fails()) {
            return redirect()->route('register')
                ->withInput()
                ->withErrors($validator);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'gender' => $request->gender,
            'age' => $request->age,
            'birth' => $request->birth,
            'address' => $request->address,
        ]);

        $user->assignRole($request->role);

        if ($user) {
            Auth::login($user);
            return redirect()->route('login')->with('success', 'Register success');
        } else {
            return redirect()->route('register')->with('error', 'Register failed');
        }
    }

    public function authenticate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->route('login')
                ->withErrors($validator)
                ->withInput();
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->route('products.index')->with('success', 'Login success');
        } else {
            return redirect()->route('login')->with('error', 'Login failed email or password is incorrect');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('products.index');
    }
}
