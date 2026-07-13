<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\NewCarController;

Route::controller(ApiController::class)->prefix('api')->group(function () {
    Route::get('getBrands', 'getBrandList');
    Route::get('getModels', 'getModelsList');
});
Route::post('/car',[NewCarController::class,'addCar'])->prefix('api')->middleware(['auth', 'verified'])->name('addCar');

Route::get('/', function () {
    return view('pages.main.index');
});
Route::get('/policy/', function () {
    return view('pages.main.policy.index');
});
Route::get('/contacts/', function () {
    return view('pages.main.contacts.index');
});

Route::get('/dashboard', function () {
    return view('pages.dashboard.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard/add',[NewCarController::class,'index'])->middleware(['auth', 'verified'])->name('dashboard.add');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
