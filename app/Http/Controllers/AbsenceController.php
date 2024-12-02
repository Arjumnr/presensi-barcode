<?php

namespace App\Http\Controllers;

use App\Models\ListPresent;
use App\Models\User;
use Faker\Core\Uuid;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AbsenceController extends Controller
{
    public function index(){
        $datas = ListPresent::with('user', 'timetable')->orderBy('created_at', 'desc')->get();
        return view('admin.absence.index' , compact('datas'));
    }

    public function create(){
        return view('admin.absence.form');
    }

    public function absence($encodedId)
    {
        // Decode ID
        try {
            $id = base64_decode($encodedId, true);
            
            if ($id === false) {
                abort(400, 'Invalid ID format'); // Abort jika decoding gagal
            }
            
            // Debug atau proses lainnya
            $dataMHS = User::find($id);
            // dd($dataMHS);   

            //store to database
            $data = [
                'id_user' => $id,
                'id_timetable' => 1,
                'scanned_at' => now(),
                
            ];

            $absence = ListPresent::create($data);

            if ($absence) {
                // dd ($absence);
                return redirect()->route('absence.list')->with('success', 'Absence created successfully');
            }

            // dd ($data);

            return redirect()->route('absence.list')->with('error', 'Failed to create absence');

            
            return view('admin.absence.absence');
        } catch (\Exception $e) {
            // Tangani error decoding
            abort(500, 'An error occurred while decoding the ID');
        }
    }
}
