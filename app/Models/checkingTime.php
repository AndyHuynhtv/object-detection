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
        'date',
        'number',
        'pictureURL',
        'IDofRoom',
    ];
    public function room()
    {
        return $this->belongsTo(room::class, 'IDofRoom');
    }
    public $timestamps = false;
}
