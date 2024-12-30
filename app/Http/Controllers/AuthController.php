<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
   
    public function show()
    {
        return view('register');
    }
   

    public function register(Request $request)
    {
        
        $request->validate([
           
        ]);

   
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role, 
        ]);

       
        // Auth::login($user);

        return redirect()->route('login')->with('success', 'Registration successful! Please login.');


    }

    public function showLoginForm()
    {
        return view('login');
    }

     
    public function login(Request $request)
    {
        
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
             'role' => 'required|integer',
        ]);
      
     
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'role' => 0])) {
           
            return redirect()->route('dashboard')->with('success', 'Welcome back!');
        }
        
        
        return back()->withErrors(['email' => 'Invalid credentials.']);
        
    }

   
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success','logout successfully');
    }
}
