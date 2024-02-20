<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StatisticController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;



Route::middleware(['auth', 'verified'])
    ->group(function () {
        Route::view('/', 'dashboard')->name('dashboard');

        Route::prefix('tasks')
            ->as('tasks.')
            ->middleware('admin')
            ->group(function () {
                Route::get('/', [TaskController::class, 'index'])->name('index');
                Route::get('create', [TaskController::class, 'create'])->name('create');
                Route::post('store', [TaskController::class, 'store'])->name('store');
            });

        Route::get('statistics', [StatisticController::class, 'index'])
            ->middleware('admin')
            ->name('statistics.index');
    });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
