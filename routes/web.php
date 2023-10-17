<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('/admin')->group(function(){

    Route::match(['get','post'],'login',[AdminController::class,'login']);

    Route::middleware(['admin'])->group(function (){
        Route::get('dashboard',[AdminController::class,'dashboard']);
        Route::get('logout',[AdminController::class,'logout']);
        Route::match(['get','post'],'update_password',[AdminController::class,'updatepassword']);
        Route::post('check_current_password',[AdminController::class,'checkcurrentpassword']);
        Route::match(['get','post'],'update_details',[AdminController::class,'updatedetails']);


    });
  
});

