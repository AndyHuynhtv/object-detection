<?php

namespace App\Http\Controllers\user;

use App\Models\room;
use Dompdf\Dompdf;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use PDF;
use App\Models\checkingTime;
use App\Models\user;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\FlareClient\View;

class userController extends Controller
{
    public function checkingAdd(Request $request)
    {
        $roomID = User::where('name', session('user-name'))->value('IDofRoom');
        try {
            $number = $request->get('number');
            $imageURL = $request->get('image_path');

            $checkAdd = new checkingTime();
            $checkAdd->date = Carbon::now('Asia/Taipei');
            $checkAdd->number = $number;
            $checkAdd->pictureURL = $imageURL;
            $checkAdd->IDofRoom = $roomID;
            $checkAdd->save();

            return redirect('/user')->with('success', 'Checking success.');
        
        } catch (\Exception $e) {
            return Redirect::back()->withErrors(['message' => 'Failed to save data: ' . $e->getMessage()]);
        }
    }

    public function userPage()
    {   
        $user = User::where('name', session('user-name'))->value('roomID');
        $data = Room::with(['checkingTime' => function($query) {
            $query->orderBy('date', 'desc');
        }])->where('roomID', $user)->get();   

        $checking = DB::table('checkingTime')
                ->select('checkingTime.date', 'checkingTime.number', 'checkingTime.IDofRoom', 'room.roomName')
                ->join('room', 'checkingTime.IDofRoom', '=', 'room.ID')
                ->where('roomID', $user)
                ->orderBy('checkingTime.date')
                ->get();

        $dataCheck = [];
        foreach ($checking as $row) {
            $roomId = $row->IDofRoom;
            $date = $row->date;
            $time = date('H:i', strtotime($date));
            $day = date('Y-m-d', strtotime($date));
            
            if (!isset($dataCheck[$row->IDofRoom])) {
                $dataCheck[$row->IDofRoom] = [
                    'name' => '' . $row->roomName,
                    'dataPoints' => [],
                ];
            }
            $dataCheck[$row->IDofRoom]['dataPoints'][] = [
                'label' => $date,
                'y' => $row->number,
                'day' => $day,
            ];
        }
        //dd($dataCheck);
        return view('user.userPage', compact(['data', 'dataCheck']));
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
