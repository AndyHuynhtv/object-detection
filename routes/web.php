<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facedes\Session;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\loginController;
use App\Models\user;
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
// route::get('/', 'App\Http\Controllers\UserController@getLogin');
// route::post('/', 'App\Http\Controllers\UserController@postLogin');
route::group([`middleware`=>['AuthenticateSesssion']],function()
{
    route::get('/','App\Http\Controllers\loginController@viewLogin')->name('viewLogin');
    route::get('/logout','App\Http\Controllers\loginController@logout');
    route::post('/loginUser','App\Http\Controllers\loginController@loginUser')->name('login');


    Route::group(['prefix'=>'admin',`middleware`=>['checkAdmin']],function () 
    {
        route::get('/', 'App\Http\Controllers\admin\adminController@adminPage');
        route::group(['prefix'=>'userManagement'],function(){
            route::get('/','App\Http\Controllers\admin\adminController@userManage');
            route::get('/userAdd','App\Http\Controllers\admin\adminController@showUserAdd');
            route::post('/userAdd','App\Http\Controllers\admin\adminController@userAdd');
            route::get('/userUpdate/{id}','App\Http\Controllers\admin\adminController@showUserUpdate');
            route::post('/userUpdate/{id}','App\Http\Controllers\admin\adminController@userUpdate');
            route::delete('/userDelete/{id}','App\Http\Controllers\admin\adminController@userDelete'); 
            route::get('/adminCheck','App\Http\Controllers\admin\adminController@adminCheck');
            Route::get('/checking/printPDF','App\Http\Controllers\admin\adminController@adminPrintPDF');
        });
        route::group(['prefix'=>'roomManagement'], function(){
            route::get('/','App\Http\Controllers\admin\roomController@roomManagement');
            route::get('/roomAdd','App\Http\Controllers\admin\roomController@showRoomAdd');
            route::post('/roomAdd','App\Http\Controllers\admin\roomController@roomAdd');
            route::get('/roomUpdate/{id}','App\Http\Controllers\admin\roomController@showRoomUpdate');
            route::post('/roomUpdate/{id}','App\Http\Controllers\admin\roomController@roomUpdate');
            route::delete('/roomDelete/{id}','App\Http\Controllers\admin\roomController@roomDelete');
        });
    });

    Route::group([`middleware`=>['checkUser']],function() 
    {
        route::group(['prefix' => 'user'], function(){
            route::get('/', 'App\Http\Controllers\user\userController@userPage');
            // Route::get('/printPDF','App\Http\Controllers\user\userController@userPrintPDF'); 
        });
    });

});


