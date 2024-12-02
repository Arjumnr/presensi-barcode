<?php

namespace App\Http\Controllers;

use App\Models\Students;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function index()
    {
        if (auth()->check()) {
            return redirect('/admin/dashboard');
        }
        return view('admin.sign-in');
    }

    public function authenticate(Request $request)
    {
        try {
           // Validate the form input
            $request->validate([
                'login_key' => 'required',
                'password' => 'required',
            ]);

            // Determine if the login key is an email, username, or NIM
            $loginKey = $request->input('login_key');
            $password = $request->input('password');

            $credentials = ['password' => $password];

            if (filter_var($loginKey, FILTER_VALIDATE_EMAIL)) {
                $credentials['email'] = $loginKey;
            } elseif (is_numeric($loginKey)) {
                $credentials['nim'] = $loginKey;
            } else {
                $credentials['username'] = $loginKey;
            }


            if (Auth::attempt($credentials)) {
                //cek status  0 | 1
                $user = Auth::user();
                if ($user->status == 0) {
                    // User is inactive, show an error message
                    return redirect()->back()->withErrors(['error' => 'Your account is inactive.']);
                }
            }
            // dd($credentials);

            // Attempt to log in the user with the provided credentials
            if (Auth::attempt($credentials, $request->filled('remember'))) {
                // Redirect to intended URL or default to the dashboard
                return redirect()->intended('/admin/dashboard');
            } else {
                // Redirect back with an error message if authentication fails
                return redirect()->back()->withErrors(['error' => 'Invalid login credentials.']);
            }
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
        }

       
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/auth/login');
    }

    public function register()
    {
        return view('admin.sign-up');
    }

    public function registPost(Request $request)
    {
        try {
            
            $datas = $request->all();


            if ($datas){
                
                // Create a new User instance
                $user = new User();
                $user->nim = $datas['nim'];
                $user->name = $datas['name'];
                $user->username = $datas['username'];
                $user->password = Hash::make($datas['password']); // Hash the password
                $user->phone = $datas['phone'];
                $user->role = 'user'; // Optional: if you’re using 'role'
                $user->status = 1;
                $user->save();

                

                // Redirect with success message
                return redirect()->route('login')->with('success', 'Registration successful. Please log in.');
            }

        } catch (\Throwable $th) {
            // dd ($th);
            // Log the error message
            Log::error($th->getMessage());

            // Redirect back with error message
            return redirect()->back()->withErrors(['error' => 'Registration failed. Please try again.']);
        }
    }
}
