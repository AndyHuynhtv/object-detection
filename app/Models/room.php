<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\user;

class room extends Model
{
    use HasFactory;
    protected $table  = 'room';

    protected $primarykey = 'id';

    protected $fillable = [
        'roomID',
        'roomName',
    ];

    // public function users()
    // {
    //     return $this->hasMany(User::class, 'IDofRoom', 'id');
    // }

    // public static function boot()
    // {
    //     parent::boot();

    //     static::updating(function ($room) {
    //         if ($room->isDirty('roomID')) {
    //             $users = $room->users;
    //             foreach ($users as $user) {
    //                 $user->roomID = $room->roomID;
    //                 $user->save();
    //             }
    //         }
    //     });
    // }
}
