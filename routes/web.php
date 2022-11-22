<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\backend\UserController;
use App\Http\Controllers\backend\ProfileController;
use App\Http\Controllers\backend\setup\StudentClassController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.index');
    })->name('dashboard');
});


route::get('/admin/logout/',[AdminController::class,'Logout'])->name('admin.logout');



// User Management

route::prefix('users')->group(function(){
    route::get('/view/',[UserController::class,'UserView'])->name('user.view');
    route::get('/add/',[UserController::class,'UserAdd'])->name('users.add');
    route::post('/store/',[UserController::class,'UserStore'])->name('users.store');
    route::get('/edit/{id}',[UserController::class,'UserEdit'])->name('users.edit');
    route::post('/update/{id}',[UserController::class,'UserUpdate'])->name('users.update');
    route::get('/delete/{id}',[UserController::class,'UserDelete'])->name('users.delete');
});

// User Profile

route::prefix('profile')->group(function(){
    route::get('/view/',[ProfileController::class,'ProfileView'])->name('profile.view');
    route::get('/edit/',[ProfileController::class,'ProfileEdit'])->name('profile.edit');
    route::post('/store/{id}',[ProfileController::class,'ProfileStore'])->name('profile.store');
    route::get('/password/view',[ProfileController::class,'PasswordView'])->name('password.view');
    route::post('/password/update',[ProfileController::class,'PasswordUpdate'])->name('password.update');
   
});


// SetUp Management

route::prefix('setups')->group(function(){
    route::get('student/class/view/',[StudentClassController::class,'ViewStudent'])->name('student.class.view');
    route::get('student/class/add/',[StudentClassController::class,'StudentClassAdd'])->name('student.class.add');
    route::post('student/class/store/',[StudentClassController::class,'StudentClassStore'])->name('store.student.class');
    
});