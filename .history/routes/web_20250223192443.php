<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Auth\LoginController;



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
});

Route::get('/admin/home', function () {
    return view('calender/home');
});

Route::get('/custom-login', [LoginController::class, 'showLoginForm'])->name('custom.login');
Route::post('/custom-login', [LoginController::class, 'login'])->name('custom.login.submit');
Route::get('/custom-login', function () {
    return view('admin/login');
});

Route::get('/signup', function () {
    return view('admin/signup');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::get('/calendar', function () {
    return view('calender/calendar');
})->name('calendar');

Route::get('/calendar/{year}/{month}', [CalendarController::class, 'show'])->name('calendar.show');
Route::get('/admin/home/{year}/{month}', [CalendarController::class, 'showAdmin'])->name('calendar.admin.show');

Route::get('/admin/home', [CalendarController::class, 'index']);

Route::get('/grouplist', function () {
    return view('admin/calendar_common');
});