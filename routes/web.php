<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\IncomeCategoryController;

// Login Routes
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login.submit');

// Auth Route
Route::middleware('auth')->group(function () {

    Route::get('/', [AuthController::class, 'index'])->name('dashboard');
    Route::get('profile', [AuthController::class, 'profile'])->name('profile');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    Route::resource('categories', CategoryController::class);
    Route::put('categories/{category}/toggle-status', [CategoryController::class, 'toggleStatus'])
        ->name('categories.toggleStatus');
    Route::resource('income-categories', IncomeCategoryController::class);
    Route::put('income-categories/{id}/toggleStatus', [IncomeCategoryController::class, 'toggleStatus'])
        ->name('income-categories.toggleStatus');


    Route::resource('expenses', ExpenseController::class);
    Route::resource('incomes', IncomeController::class);

    Route::get('profile/edit', [ProfileController::class, 'edit'])
        ->name('profile.edit');
    Route::post('profile/update', [ProfileController::class, 'update'])
        ->name('profile.update');

// Route to show the password change form
Route::get('profile/change-password', [ProfileController::class, 'showChangePasswordForm'])
->name('password.change');

// Route to handle the password update
Route::post('profile/change-password', [ProfileController::class, 'updatePassword'])
->name('password.update');


});
