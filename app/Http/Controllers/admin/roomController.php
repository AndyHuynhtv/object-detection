<?php

namespace App\Http\Controllers\admin;

use App\Models\user;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\room;
use Illuminate\Support\Facedes\Session;
use Auth;
    
class roomController extends Controller
{
    public function roomManagement()
    {
        $rooms = room::get();
        return view('admin.roomManagement.roomManage', compact('rooms'));
    }

    public function showRoomAdd()
    {
        return view('admin.roomManagement.roomAdd');
    }

    public function roomAdd(Request $request)
    {
        $existingRoom = Room::where('roomID', $request->input('roomID'))
                            ->orWhere('roomName', $request->input('roomName'))
                            ->first();
        if ($existingRoom)
        {
        return redirect('/admin/roomManagement')->with('error', 'Room already exists');
        }
        $rooms = new room();
        $rooms->roomID = $request->input('roomID');
        $rooms->roomName = $request->input('roomName');
        $rooms->save();
        return redirect('/admin/roomManagement')->with('success','Room added succesfully');
    }
    
    public function roomUpdate(Request $request, $id)
    {
        $room = Room::find($id);
        $room->roomID = $request->input('roomID');
        $room->roomName = $request->input('roomName');
    
        $existingRoom = Room::where('roomID', $room->roomID)
                            ->where('id', '!=', $id)
                            ->first();
                               
        if (!$room) {
            return redirect('/admin/roomManagement')->with('error', 'Room not found');
        }
    
        if ($existingRoom) {
            return redirect('/admin/roomManagement')->with('error', 'Room ID or Room Name already exists');
        }
        
        $room->save();
        return redirect('/admin/roomManagement')->with('success', 'Room updated successfully');
    }


//     public function roomUpdate(Request $request, $id)
// {
//     $room = Room::find($id);

//     if ($room) {
//         $newRoomID = $request->input('roomID');
//         $newRoomName = $request->input('roomName');
//         $existingRoom = Room::where('roomID', $newRoomID)
//                             ->orWhere('roomName', $newRoomName)
//                             ->where('id', '<>', $id)
//                             ->first();

//         if ($existingRoom) {
//             return redirect('/admin/roomManagement')->with('error', 'Room ID or Room Name already exists');
//         }
//         $room->roomID = $newRoomID;
//         $room->roomName = $newRoomName;
//         $room->save();
//         \App\Models\User::where('IDofRoom', $id)->update(['roomID' => $newRoomID]);

//         return redirect('/admin/roomManagement')->with('success', 'Room updated successfully');
//     }

//     // Nếu không tìm thấy bản ghi, báo lỗi
//     return redirect('/admin/roomManagement')->with('error', 'Room not found');
// }


    public function showRoomUpdate($id)
    {
        $room = room::find($id);
        return view('admin.roomManagement.roomUpdate')->with('room', $room);
    }

    public function roomDelete($id)
    {
        $room = Room::find($id);

        if (!$room) {
            return redirect('/admin/roomManagement')->with('error', 'Room not found');
        }

        $usersInRoom = User::where('roomID', $room->roomID)->get();
        if ($usersInRoom->count() > 0) {
            return redirect('/admin/roomManagement')->with('error', 'Cannot delete room because it has associated users');
        }

        $room->delete();
        return redirect('/admin/roomManagement')->with('success', 'Room deleted successfully');
    }

}
