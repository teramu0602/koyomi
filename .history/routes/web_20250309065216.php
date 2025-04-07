<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CreateGroupController;

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
    return view('layouts/admin_calender');
});

Route::get('/admin/home', function () {
    return view('calender/home');
});

Route::post('/register', [RegisterController::class, 'register'])->name('register');


//ログイン状態を見て、用意したログインページへいく
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

//ログイン成功で個人カレンダーへいく
Route::get('/calendar', function () {
    return view('calender/home');
})->name('calendar');

Route::get('/calendar/{year}/{month}', [CalendarController::class, 'show'])->name('calendar.show');
Route::get('/admin/home/{year}/{month}', [CalendarController::class, 'showAdmin'])->name('calendar.admin.show');

Route::get('/admin/home', [CalendarController::class, 'index']);

Route::get('/common', function () {
    return view('admin/calendar_common');
});

Route::get('/grouplist', [CreateGroupController::class, 'index'])->name('grouplist');

Route::get('/create_group', function () {
    return view('admin/create_group');
});

//カレンダーグループ作成
Route::post('/groups', [CalendarController::class, 'store'])->name('groups.store');
Route::get('/groups', function () {
    return view('admin/create_group');
})->name('groupcreate');

Auth::routes();

//ドロップダウンのログアウトでログインへ行く
Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('custom.login');
})->name('logout');


//ジョイン画面　試し
Route::post('/groups', [JoinController::class, 'store'])->name('join.store');
Route::get('/join',function(){
    return view('admin.join_group');
})->name('groupjoin');