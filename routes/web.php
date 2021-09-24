<?php

use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\LoginController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Auth::routes();
Route::resource('/user',UserController::class);
Route::get('/', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/checkcontact', [LoginController::class, 'checkContact'])->name('checkcontact');
Route::post('/checkcontactedit', [LoginController::class, 'checkContactEdit'])->name('checkcontactedit');
Route::post('/checkemail', [LoginController::class, 'checkEmail'])->name('checkemail');
Route::post('/checkemailedit', [LoginController::class, 'checkEmailEdit'])->name('checkemailedit');