<?php

namespace App\Http\Controllers;

use App\Models\Qrcodes;
use App\Models\TimeTable;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Time;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Str;


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
        // Encode ID untuk keamanan
        $encodedId = base64_encode($id);   
        
        // Gunakan fungsi url() agar URL dinamis
        $url = url('admin/absence/' . $encodedId); 

        // Generate QR Code
        $qr = QrCode::size(300)->generate($url);

        // Return ke view
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
