<?php

namespace App\Http\Controllers\admin;

use App\Models\user;
use App\Models\room;
use App\Models\checkingTime;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facedes\Session;
use Auth;
use PDF;


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
        return view('admin.checking.adminCheck');
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

}

