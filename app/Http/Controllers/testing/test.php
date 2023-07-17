<?php

namespace App\Http\Controllers\testing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class test extends Controller
{
    public function test()
    {
        return view ('testingview.testview');
    }
}
