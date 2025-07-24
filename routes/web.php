<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showAuth'])->name('login'); // صفحة تسجيل الدخول
Route::post('/login', [AuthController::class, 'login'])->name('login.post'); // تنفيذ تسجيل الدخول
Route::post('/register', [AuthController::class, 'register'])->name('register'); // تسجيل حساب جديد

Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('logout');

// الصفحات المحمية للمستخدمين المسجلين فقط
Route::middleware(['auth'])->group(function () {

    // الصفحة الرئيسية بعد تسجيل الدخول (عرض الرسائل والبحث عن مستخدم)
    Route::get('/home', [UserController::class, 'index'])->name('home');

    // إرسال رسالة صراحة
    Route::post('/messages/send/{userId}', [MessageController::class, 'send'])->name('messages.send');

    // عرض صفحة كتابة رسالة لمستخدم (اختياري)
    Route::get('/messages/send/{user}', [MessageController::class, 'show'])->name('messages.show');

    // عرض الرسائل الواردة
    Route::get('/inbox', [MessageController::class, 'inbox'])->name('messages.inbox');
});
