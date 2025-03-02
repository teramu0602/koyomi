<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;


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
    return view('welcome');
});

Route::get('/admin', function () {
    return view('layouts/admin');
})->name('logout');

Route::get('/admin/home', function () {
    return view('calender/home');
});

Route::post('/register', [RegisterController::class, 'register'])->name('register');



Route::post('/custom-login', [LoginController::class, 'login'])->name('custom.login.submit');
Route::get('/custom-login', function () {
    return view('admin/login');
})->name('custom.login');

Route::get('/signup', function () {
    return view('admin/signup');
});

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/home', function () {
//     return view('calender/home');
// })->name('home');

//ログイン成功で個人カレンダーいく
Route::get('/calendar', function () {
    return view('calender/home');
})->name('calendar')->middleware('auth');

Route::get('/calendar/{year}/{month}', [CalendarController::class, 'show'])->name('calendar.show');
Route::get('/admin/home/{year}/{month}', [CalendarController::class, 'showAdmin'])->name('calendar.admin.show');

Route::get('/admin/home', [CalendarController::class, 'index']);

Route::get('/common', function () {
    return view('admin/calendar_common');
});

Route::get('/grouplist', function () {
    return view('admin/group_list');
});

Route::get('/create_group', function () {
    return view('admin/create_group');
});

//カレンダーグループ作成
Route::post('/groups', [CalendarController::class, 'store'])->name('groups.store');
Route::get('/groups', function () {
    return view('admin/create_group');
});

Auth::routes();

