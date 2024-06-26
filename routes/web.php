<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RequestEquipmentController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    ### Route Request ###
    Route::get("/request/index", [RequestEquipmentController::class, 'index'])->name('request.equipment');
    Route::get("/request/add", [RequestEquipmentController::class, 'create'])->name('request.equipment_add');
    Route::post("/request/add", [RequestEquipmentController::class, 'store'])->name('request.equipment_store');
    Route::get("/request/show/{id}", [RequestEquipmentController::class, 'show'])->name('request.equipment_show');
});

require __DIR__.'/auth.php';
