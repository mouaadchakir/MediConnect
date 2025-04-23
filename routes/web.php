<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\AdminController;

Route::view('/', 'welcome')->name('home');
Route::middleware(['guest'])->group(function () {
  Route::controller(LoginController::class)->group(function () {
      Route::get('login', 'showLoginForm')->name('login');
      Route::post('login', 'login')->name('login');
  });
  Route::controller(RegisterController::class)->group(function () {
      Route::get('register', 'showRegistrationForm')->name('register');
      Route::post('register', 'register')->name('register');
  });
});
Route::middleware(['auth'])->group(function () {
  Route::get('logout', [LoginController::class, 'logout'])->name('logout');
  Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
});
Route::controller(UserController::class)->prefix('dashboard/user')->name('user.')->middleware(['auth'])->group(function () {
  Route::get('profile', 'profile')->name('profile');
  Route::post('profile', 'updateProfile')->name('profile.update');
  Route::get('alldoctors', 'allDoctors')->name('alldoctors');
  Route::post('alldoctors', 'searchDoctors')->name('alldoctors.search');
  Route::get('meassagelist', 'meassagelist')->name('meassagelist');
  Route::get('meassangeroom/{id}', 'meassangeroom')->name('meassangeroom');
});
Route::controller(DoctorController::class)->prefix('dashboard/doctor')->name('doctor.')->middleware(['auth'])->group(function () {
  Route::get('profile', 'profile')->name('profile');
  Route::post('profile', 'updatedoctor')->name('profile.update');
  Route::get('meassagelist', 'meassagelist')->name('meassagelist');
  Route::get('meassangeroom/{id}', 'meassangeroom')->name('meassangeroom');
});
Route::controller(AdminController::class)->prefix('dashboard/admin')->name('admin.')->middleware(['auth'])->group(function () {
  Route::get('alldoctors', 'alldoctors')->name('alldoctors');
});