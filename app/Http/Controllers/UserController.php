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
        $event = User::find($id);
        return view('admin.users.form', compact('event'));
    }

    public function update(Request $request, $id){
        $event = User::find($id);
        $event->name_event = $request->nama_event;
        $event->date_event = $request->tgl_event;
        $event->save();
        return redirect()->route('event.index')->with('success', 'Event updated successfully');
    }

    public function destroy($id){
       $event = User::find($id);
        if ($event) {
            $event->delete();
            return redirect()->route('event.index')->with('success', 'Event has been deleted successfully');
        } else {
            return redirect()->route('event.index')->with('error', 'Event not found');
        }
    }
}
