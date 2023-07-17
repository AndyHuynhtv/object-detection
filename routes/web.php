<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\user\loginController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'App\Http\Controllers\admin\user\loginController@index');

route::get('testpart/route1', 'App\Http\Controllers\testing\test@test');


