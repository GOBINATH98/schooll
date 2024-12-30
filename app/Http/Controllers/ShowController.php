<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Stud;
class ShowController extends Controller
{
  
  public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required|integer',
        ]);

      
        $ji = $request->only('email', 'password');
        $ji['role'] = 1;

        if (Auth::attempt($ji)) {
            
         
            return redirect('viewers')->with('success', 'Welcome, Admin!');
        }

      
        return back()->withErrors(['error' => 'Invalid credentials or not an admin.']);
    }

 
    public function create()
    {
        return view('show');;
    }

 
    public function store($id)
    {
        $record = Stud::with('marks')->findOrFail($id); 
       

        if (!$record) {
            return response()->json(['error' => 'Record not found.'], 404);
        }       

        return response()->json(['record' => $record]);
    
    }

  
    public function show(string $id)
    {
        return view('viewers');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        return view('viewers');
    }

   
    public function app()
    {
        return view('api');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function logout()
    {
        Auth::logout();
        session()->flush();
        return redirect()->route('login')->with('success','logout successfully');
    }
}
