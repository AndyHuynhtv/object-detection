<?php

namespace App\Http\Controllers\admin;

use App\Models\user;
use App\Models\room;
use App\Models\checkingTime;
use App\Http\Controllers\Controller;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facedes\Session;
use Auth;
use PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Http;


class adminController extends Controller
{
    public function adminPage(Request $request)
    {
        return view('admin.adminPage');
    }

    public function userManage()
    {
        $users = user::get();
        return view('admin.userManagement.userManage',compact('users'));
    }

    public function checkingAdd(Request $request)
    {
        try {
            $data = $request->get('number');
            
            if (!isset($data)) {
                return response()->json(['message' => 'No data available from API'], 400);
            }

            $checkAdd = new checkingTime();
            $checkAdd->date = Carbon::now('Asia/Taipei');
            $checkAdd->number = $data;
            $checkAdd->pictureURL = '';
            $checkAdd->IDofRoom = '6';
            $checkAdd->save();
            
            //$result = (new adminController)->adminCheck();
  
            //dd($result);
        } catch (\Exception $e) {
            return Redirect::back()->withErrors(['message' => 'Failed to save data: ' . $e->getMessage()]);
        }
    }

    public function userAdd(Request $request)
    {
        $roomID = $request->input('roomID');
        $roomExists = Room::where('roomID', $roomID)->exists();
        if (!$roomExists) {
            return redirect()->back()->with('error', 'Invalid ID of Room');
        }

        // Kiểm tra xem name đã tồn tại trong bảng users hay không
        $existingUserWithName = User::where('name', $request->input('name'))->first();
        if ($existingUserWithName) {
            return redirect()->back()->with('error', 'User already esists');
        }

        // Kiểm tra xem email đã tồn tại trong bảng users hay không
        $existingUserWithEmail = User::where('email', $request->input('email'))->first();
        if ($existingUserWithEmail) {
            return redirect()->back()->with('error', 'Email already esists');
        }

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->roomID = $request->input('roomID');
        $user->role = 'user';
        $user->save();
        return redirect('/admin/userManagement/userAdd')->with('success', 'User added successfully');
    }

    public function showUserAdd()
    {
        return view('admin.userManagement.userAdd');
    }

    public function userDelete($id)
    {
        $user = User::find($id);
        if ($user) 
        {
            $user->delete();
            return redirect('/admin/userManagement')->with('success', 'User deleted successfully');
        } else 
        {
            return redirect('/admin/userManagement')->with('error', 'User not found');
        }
    }

    public function userUpdate(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->password = $request->input('password');
        $user->email = $request->input('email');
        $user->role = $request->input('role');
        // Get the value of 'roomID' from the request
        $user->roomID = $request->input('roomID');
        // Check if 'roomID' exists in the 'rooms' table
        $room = Room::where('roomID', $user->roomID)->first();
        if (!$room) {
            return redirect('/admin/userManagement')->with('error', 'Room not found, Update failed');
        }
        // Check if the input 'roomID' matches the 'roomID' in the 'rooms' table
        if ($room->roomID !== $user->roomID) {
            return redirect('/admin/userManagement')->with('error', 'Invalid Room ID, Update failed');
        }
        
        if($user->role !== 'admin' && $user->role !== 'user'){
            return redirect('/admin/userManagement')->with('error', 'Role must be user or admin');
        }
        
        // Check if 'name' already exists in the 'users' table (excluding the current user)
        $existingUserWithName = User::where('name', $user->name)->where('id', '<>', $id)->first();
        if ($existingUserWithName) {
            return redirect('/admin/userManagement')->with('error', 'Username already exists, Update failed');
        }
    
        // Check if 'email' already exists in the 'users' table (excluding the current user)
        $existingUserWithEmail = User::where('email', $user->email)->where('id', '<>', $id)->first();
        if ($existingUserWithEmail) {
            return redirect('/admin/userManagement')->with('error', 'Email already exists, Update failed');
        }
    
        $user->save();
        return redirect('/admin/userManagement')->with('success', 'Update successfully');
    }
    


    public function showUserUpdate($id)
    {
        $user = User::find($id);
        return view('admin.userManagement.userUpdate')->with('user' , $user);
    }

    public function adminCheck()
    {
        $checking = DB::table('checkingTime')
                ->select('checkingTime.date', 'checkingTime.number', 'checkingTime.IDofRoom', 'room.roomName')
                ->join('room', 'checkingTime.IDofRoom', '=', 'room.ID')
                ->orderBy('checkingTime.date')
                ->get();

        $data = [];
        foreach ($checking as $row) {
            $roomId = $row->IDofRoom;
            $date = $row->date;
            $time = date('H:i', strtotime($date));
            $day = date('Y-m-d', strtotime($date));
            
            if (!isset($data[$row->IDofRoom])) {
                $data[$row->IDofRoom] = [
                    'name' => '' . $row->roomName,
                    'id' => '' . $roomId,
                    'dataPoints' => [],
                ];
            }
            $data[$row->IDofRoom]['dataPoints'][] = [
                'label' => $date,
                'y' => $row->number,
                'day' => $day,
            ];
        }
        $check = Room::with(['checkingTime' => function($query) {
            $query->orderBy('date', 'desc');
        }])->get();
        //dd($data);
        return view('admin.checking.adminCheck', compact(['data', 'check']));
    }

    // public function adminPrintPDF()
    // {
    //     $data = CheckingTime::all(); // Lấy dữ liệu từ bảng CheckingTime
    
    //     $pdf = new Dompdf(); // Khởi tạo đối tượng Dompdf
    
    //     // Render view "checkingTime" với dữ liệu $data
    //     $html = View::make('admin.checking.adminCheck', ['data' => $data])->render();
    
    //     // Load HTML vào Dompdf
    //     $pdf->loadHtml($html);
    
    //     // Cấu hình và render PDF
    //     $pdf->setPaper('A4', 'landscape');
    //     $pdf->render();
    
    //     // In ra file PDF với tên "checking_time.pdf"
    //     return $pdf->stream('checking_time.pdf');
    // }

    // public function adminPrintPDF(Request $request)
    // {
    //     // Lấy dữ liệu từ database, ví dụ:
    //     $data = checkingTime::all();

    //     // Tạo view và truyền dữ liệu vào
    //     $pdf = PDF::loadView('admin.checking.checkingTimePDF', compact('data'));

    //     // Xuất file PDF
    //     return $pdf->download('checking_time.pdf');
    // }

    public function adminPrintPDF(){
        //$data = CheckingTime::all(); // Lấy dữ liệu từ bảng CheckingTime
        $data = Room::with('checkingTime') ->get();
        $pdf = new Dompdf(); // Khởi tạo đối tượng Dompdf
    
        // Render view "checkingTime" với dữ liệu $data
        $html = View::make('admin.checking.adminCheckPDF', ['data' => $data])->render();
        
        // Load HTML vào Dompdf
        $pdf->loadHtml($html);
    
        // Cấu hình và render PDF
        $pdf->setPaper('A4');
        $pdf->render();
    
        // In ra file PDF với tên "checking_time.pdf"
        return $pdf->stream('checking_time.pdf');
    }
}

