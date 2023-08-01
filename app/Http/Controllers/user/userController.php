<?php

namespace App\Http\Controllers\user;

use App\Models\room;
use Dompdf\Dompdf;
use Illuminate\Support\Carbon;
use PDF;
use App\Models\checkingTime;
use App\Models\user;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\FlareClient\View;

class userController extends Controller
{
    public function userPage()
    {
        $data = room::with('checkingTime')->get();
        return view('user.userPage', compact('data'));
    }

    public function userPrintPDF(Request $request)
    {
        $roomID = $request->input('roomID');
        // Lấy dữ liệu từ database, ví dụ:
        $data = Room::with('checkingTime')->where('roomID', $roomID)->get();

        $pdfUser = new Dompdf(); // Khởi tạo đối tượng Dompdf
    
        // Render view "checkingTime" với dữ liệu $data
        $html = \View::make('user.userCheckPDF', ['data' => $data])->render();
        
        // Load HTML vào Dompdf
        $pdfUser->loadHtml($html);
    
        // Cấu hình và render PDF
        $pdfUser->setPaper('A4');
        $pdfUser->render();
    
        $currentDate = Carbon::now()->format('Y-m-d');

        // Tên file
        $fileName = 'check_' . $currentDate . '.pdf';

        // Xuất file
        return $pdfUser->stream($fileName);
    }
}
