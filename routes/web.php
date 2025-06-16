<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;


Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);


Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/results', [AdminController::class, 'index'])->name('admin.results');
    Route::get('/admin/results/{user}', [AdminController::class, 'viewResult'])->name('admin.results.view');
    Route::delete('/admin/results/{user}', [AdminController::class, 'deleteResult'])->name('admin.results.delete');
});


Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login'); // Ubah ke route login kamu
})->name('logout');



Route::middleware('auth')->group(function () {
Route::get('/dashboard', function () {
    return view('layout/Dashboard');
});
Route::post('/test/tutorial/submit', [QuestionController::class, 'submitTutorial'])->name('test.submitTutorial');
    Route::get('/test', [QuestionController::class, 'showTutorial'])->name('test.tutor');
Route::get('/test-start', [QuestionController::class, 'index'])->name('test.start');
Route::post('/test/submit', [QuestionController::class, 'submit'])->name('test.submit');
Route::get('/test/result', [QuestionController::class, 'result'])->name('test.result');
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

Route::get('/', function () {
    return redirect('/dashboard');
});
