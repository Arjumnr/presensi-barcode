<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        // Retrieve all users from the database
        $users = User::all(); // You can also use paginate() if you want to paginate the results

        // Pass the users to the view
        return view('admin.users.index', compact('users'));
    }

    public function create(){
        return view('admin.users.form');
    }

    public function store(Request $request)
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
                $user->role = 'user'; // Optional: if you’re using 'role'
                $user->save();
            }
            return redirect()->route('user.list')->with('success', 'Registration successful.');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function edit($id){
        $user = User::find($id);
        return view('admin.users.form', compact('user'));
    }

    public function update(Request $request, $id){
        $user = User::find($id);
        $user->nim = $request->nim;
        $user->name = $request->name;
        $user->username = $request->username;
        $user->status = $request->status;

        $pw = $request->password;
        if ($pw) {
            $user->password = Hash::make($pw);
        }

        $user->save();
        return redirect()->route('user.list')->with('success', 'Event updated successfully');
    }

    public function destroy($id){
       $user = User::find($id);
        if ($user) {
            $user->delete();
            return redirect()->route('user.list')->with('success', 'User has been deleted successfully');
        } else {
            return redirect()->route('user.list')->with('error', 'User not found');
        }
    }
}
