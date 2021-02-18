<?php

use Illuminate\Support\Facades\Route;
Use Illuminate\Support\Facades\Auth;

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
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

Route::view('/', 'welcome');
Auth::routes();

Route::get('/login/user', [LoginController::class, 'showUserLoginForm'])->name('login.user');
Route::get('/login/admin', [LoginController::class, 'showAdminLoginForm']);
Route::get('/login/blogger', [LoginController::class,'showBloggerLoginForm']);
Route::get('/register/user', [RegisterController::class,'showUserRegisterForm']);
Route::get('/register/admin', [RegisterController::class,'showAdminRegisterForm']);
Route::get('/register/blogger', [RegisterController::class,'showBloggerRegisterForm']);

Route::post('/login/user', [LoginController::class,'userLogin']);
Route::post('/login/admin', [LoginController::class,'adminLogin']);
Route::post('/login/blogger', [LoginController::class,'bloggerLogin']);
Route::post('/register/user', [RegisterController::class,'createUser'])->name('register.user');
Route::post('/register/admin', [RegisterController::class,'createAdmin']);
Route::post('/register/blogger', [RegisterController::class,'createBlogger']);



Route::group(['middleware' => 'auth:blogger'], function () {
    Auth::routes();
    Route::view('/blogger', 'blogger');
});
Route::group(['middleware' => 'auth:user'], function () {
    Auth::routes();
    Route::view('/dashboard', 'home');
});

Route::group(['middleware' => 'auth:admin'], function () {
    Auth::routes();
    Route::view('/admin', 'admin');
});

Route::get('logout', [LoginController::class,'logouts']);
