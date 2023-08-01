<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class checkingTime extends Model
{
    use HasFactory;
    protected $table  = 'checkingTime';

    protected $primarykey = 'id';

    protected $fillable = [
        'number',
        'date',
        'pictureURL',
        'IDofRoom',
    ];
}
