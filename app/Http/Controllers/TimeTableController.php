<?php

namespace App\Http\Controllers;

use App\Models\Qrcodes;
use App\Models\TimeTable;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Time;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class TimeTableController extends Controller
{
    public function index()
    {
        $datas = TimeTable::orderBy('created_at', 'desc')->get();
        return view('admin.time-table.index' , compact('datas'));
    }

    public function create()
    {
        return view('admin.time-table.form');
    }

    public function store(Request $request)
    {
        try {
            $datas = $request->all();
            $toQR = TimeTable::create($datas);
            if ($toQR){
                Qrcodes::create(
                    [
                        'timetable_id' => $toQR->id,
                        'qr_data' => encrypt($toQR->id), // Data yang ingin dienkripsi
                    ]
                );
            }
            return redirect()->route('time-table.list')->with('success', 'Registration successful.');
        } catch (\Throwable $th) {
            throw $th;  
        }
    }

    public function show($id)
    {
        $id = encrypt($id);
        $qr = QrCode::size(300)->generate('http://127.0.0.1:8000/admin/');
        return view('admin.time-table.show', compact('qr'));
    }

    public function update(Request $request, $id)
    {
        return;
    }   

    public function destroy($id){
       $time_table = TimeTable::find($id);
        if ($time_table) {
            $time_table->delete();
            return redirect()->route('time-table.list')->with('success', 'time_table has been deleted successfully');
        } else {
            return redirect()->route('time-table.list')->with('error', 'time_table not found');
        }
    }
}
