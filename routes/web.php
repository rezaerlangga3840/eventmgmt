<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\UserSettingController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Authentication;

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

Route::get('/',[HomeController::class,'index'])->name('front.home');

//Auth

Route::group(['prefix'=>'dashboard'], function(){
    Route::get('/',[AuthController::class,'admin']);
    Route::get('/login',[AuthController::class,'login'])->name('admin.login');
    Route::post('/login', [AuthController::class,'authenticate'])->name('admin.authenticate');
    Route::get('/register',[AuthController::class,'register'])->name('admin.register');
    Route::post('/register',[AuthController::class,'registration'])->name('admin.registration')->middleware('web');
    Route::get('/mainpage', [DashboardController::class,'index'])->name('admin.dashboard')->middleware('auth');
    Route::get('/usersetting', [UserSettingController::class,'usersetting'])->name('admin.usersetting')->middleware('auth');
    Route::put('/usersetting/usersettingupdate', [UserSettingController::class,'usersettingupdate'])->name('admin.usersettingupdate')->middleware('auth');
    Route::get('/logout', [AuthController::class,'logout'])->name('admin.logout')->middleware('auth');
    Route::group(['middleware'=>['auth','roles:admin,user']],function(){
        Route::get('/events',[EventsController::class,'daftar'])->name('admin.events.daftar')->middleware('auth');
        Route::get('/events/upcoming',[EventsController::class,'mendatang'])->name('admin.events.mendatang')->middleware('auth');
        Route::post('/events/add',[EventsController::class,'save'])->name('admin.events.save')->middleware('auth');
        Route::get('/events/view/{id}',[EventsController::class,'view'])->name('admin.events.view')->middleware('auth');
        Route::put('/events/edit/{id}',[EventsController::class,'update'])->name('admin.events.update')->middleware('auth');
        Route::delete('/events/delete/{id}',[EventsController::class,'delete'])->name('admin.events.delete')->middleware('auth');
    });
    Route::group(['middleware'=>['auth','roles:admin']],function(){

    });
    Route::group(['middleware'=>['auth','roles:user']],function(){
        Route::post('/events/book/{id}',[EventsController::class,'book'])->name('admin.events.booking')->middleware('auth');
    });
    
});