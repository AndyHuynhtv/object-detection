<?php

namespace App\Http\Controllers\user;

use PDF;
use App\Models\checkingTime;
use App\Models\user;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class userController extends Controller
{
    public function userPage()
    {
        $data = checkingTime::get();
        return view('user.userPage', compact('data'));
    }

    public function userPrintPDF(Request $request)
    {
        // Lấy dữ liệu từ database, ví dụ:
        $data = checkingTime::all();

        // Tạo view và truyền dữ liệu vào
        $pdf = PDF::loadView('user.printPDF', compact('data'));

        // Xuất file PDF
        return $pdf->download('checking_time.pdf');
    }
}
