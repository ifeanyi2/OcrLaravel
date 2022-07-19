<?php

use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\OcrController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\LogoutController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\TestEntrollmentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//dashboard
Route::get('/admin/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

// site settings route
Route::get('admin/settings', [DashboardController::class, 'settings'])->name('settings');

//login user
Route::get('/auth/login', [LoginController::class, 'index'])->name('login');

Route::post('/login/user', [LoginController::class, 'store'])->name('login.user');


//register new user
Route::get('/auth/register', [RegisterController::class, 'index'])->name('register');
Route::post('/auth/store', [RegisterController::class, 'store'])->name('user.store');



//logout
Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

Route::get('/', function () {
    return view('posts.index');
});



//admin
Route::get('admin/ocr', [OcrController::class, 'index'])->name('ocr');


//fetch from ocr form
Route::post('/ocr/send/', [OcrController::class, 'ocrSend'])->name('ocr.send');

Route::get('/ocr/display', [OcrController::class, 'display'])->name("ocr.display");
Route::post('/ocr/score/', [OcrController::class, 'saveOcrScore'])->name('ocr.save');

Route::post('/ocr/fake', [OcrController::class, 'fake'])->name('ocr.fake');


// //notification router
// Route::get('/send-notification', [TestEntrollmentController::class, 'sendNotification']);
