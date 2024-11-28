<?php

namespace App\Http\Controllers;

use App\Models\Qrcodes;
use App\Models\TimeTable;
use Exception;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Time;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrcodeController extends Controller
{
    public function index()
    {
        return view('admin.qrcode.index');
    }


    public function create()
    {
         return view('admin.qrcode.form');
    }


    public function store(Request $request)
    {
        try {
            $peluncur = 'auth/login';
            $peluncur = encrypt($peluncur);
            QrCode::create(
                [
                    'timetable_id' => $request->timetable_id,
                ]
            );
            $qrCodePath = QrCode::size(200)->generate('www.perizinan.web.id/'.$peluncur);

            return $qrCodePath;
        } catch (Exception $e) {
            // Tangkap error dan log
            // \Log::error('Error in QR Code creation: ' . $e->getMessage());
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }


//     public function store()
// {
//     try {
//         // ID jadwal yang terkait dengan QR Code
//         $timetableId = 1;

//         // Data untuk QR Code
//         $qrData = 'Matkul: Manajemen Strategik Sektor Publik';

//         // Panggil fungsi createQRCode untuk membuat QR Code
//         $qrCode = Qrcodes::createQRCode($qrData, $timetableId);

//         // Pastikan fungsi createQRCode mengembalikan hasil yang valid
//         if (!$qrCode || !isset($qrCode->qr_code_image_path)) {
//             throw new \Exception('QR Code tidak dapat dibuat.');
//         }

//         // Kirim respon sukses dengan path QR Code
//         return response()->json([
//             'message' => 'QR Code berhasil dibuat.',
//             'qr_code_image_path' => url($qrCode->qr_code_image_path),
//         ], 200);
//     } catch (\Exception $e) {
//         // Log error dan kirimkan response JSON
//         \Log::error('Error in QR Code generation: ' . $e->getMessage());

//         return response()->json([
//             'message' => 'Terjadi kesalahan saat membuat QR Code.',
//             'error' => $e->getMessage(),
//         ], 500);
//     }
// }



    public function show($id)
    {
        $datas = Qrcodes::find(1);
        //show to web 

        return view('admin.qrcode.show', compact('datas'));
    }


    public function update(Request $request, $id)
    {
        return;
    }
    

    public function destroy($id)
    {
        return;
    }
}
