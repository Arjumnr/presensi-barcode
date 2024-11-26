<?php

namespace App\Http\Controllers;

use App\Models\Students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function index()
    {
        $datas = Students::all();
        return view('admin.students.index', compact('datas'));
    }

     public function create(){
        return view('admin.students.form');
    }

    public function store(Request $request){
        try {
            
            $datas = $request->all();


            if ($datas){
                // Create a new User instance
                $student = new Students();
                $student->nim = $datas['nim'];
                $student->email = $datas['email'];
                $student->name = $datas['name'];
                $student->phone = $datas['phone'];
                $student->save();
            }
            return redirect()->route('student.list')->with('success', 'Registration successful.');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function edit($id){
        $datas = Students::find($id);
        return view('admin.students.form', compact('datas'));
    }

    public function update(Request $request, $id){
        $student = Students::find($id);
        $student->nim = $request->nim;
        $student->email = $request->email;
        $student->name = $request->name;
        $student->phone = $request->phone;
        $student->save();
        return redirect()->route('student.list')->with('success', 'Event updated successfully');
    }

    public function destroy($id){
        $student = Students::find($id);
        if ($student) {
            $student->delete();
            return redirect()->route('student.list')->with('success', 'Student has been deleted successfully');
        } else {
            return redirect()->route('student.list')->with('error', 'Student not found');
        }
    }
}
