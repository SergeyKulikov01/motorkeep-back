<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Auth\YandexAuthController;
use App\Http\Controllers\CarHistoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DetailCarController;
use App\Http\Controllers\NewCarController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RemindersController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\StatController;
use App\Http\Controllers\UserNotesController;
use App\Http\Controllers\CarDocsController;
use Illuminate\Support\Facades\Route;

Route::controller(ApiController::class)->prefix('api')->group(function () {
    Route::get('getBrands', 'getBrandList');
    Route::get('getModels', 'getModelsList');
});
Route::prefix('api')->middleware(['auth', 'verified'])->group(function () {
    Route::post('/car', [NewCarController::class, 'addCar']);
    Route::post('/notes', [UserNotesController::class, 'addNote']);
    Route::get('/notes', [UserNotesController::class, 'getNote']);
    Route::delete('/notes', [UserNotesController::class, 'deleteNote']);
    Route::post('/reminders', [RemindersController::class, 'addReminder']);
    Route::get('/reminders', [RemindersController::class, 'getReminder']);
    Route::delete('/reminders', [RemindersController::class, 'deleteReminder']);
    Route::patch('/reminders', [RemindersController::class, 'updateReminder']);
    Route::post('/car-history', [CarHistoryController::class, 'addCarHistory']);
    Route::get('/car-history', [CarHistoryController::class, 'getCarHistory']);
    Route::delete('/car-history', [CarHistoryController::class, 'deleteCarHistory']);
    Route::post('/car-docs', [CarDocsController::class, 'addDoc']);
    Route::get('/car-docs', [CarDocsController::class, 'getDoc']);
    Route::delete('/car-docs', [CarDocsController::class, 'deleteDoc']);
    Route::get('/stats', [StatController::class, 'getStat']);
    Route::delete('/settings', [SettingsController::class, 'removeUser']);
    Route::post('/settings', [SettingsController::class, 'changePwd']);
    Route::post('/user-settings', [SettingsController::class, 'setSettings']);
});

Route::get('/', function () {
    return view('pages.main.index');
});
Route::get('/policy/', function () {
    return view('pages.main.policy.index');
});
Route::get('/contacts/', function () {
    return view('pages.main.contacts.index');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/cars', [DashboardController::class, 'carsList'])->name('dashboard.cars');
    Route::get('/dashboard/stats', [DashboardController::class, 'statistic'])->name('dashboard.stats');
    Route::get('/dashboard/add', [NewCarController::class, 'index'])->name('dashboard.add');
    Route::get('/dashboard/detail/{id}', [DetailCarController::class, 'index'])->whereNumber('id')->name('dashboard.cardetail');
    Route::get('/dashboard/settings', [SettingsController::class, 'index'])->name('dashboard.settings');
});
Route::get('/report/{id}',[ReportController::class, 'index'])->name('report');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/auth/yandex', function () {
    return view('auth.yandex');
});
Route::post('/auth/yandex/callback', [YandexAuthController::class, 'callback'])->name('auth.yandex.callback');

require __DIR__.'/auth.php';
