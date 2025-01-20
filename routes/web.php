<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Home Route
Route::get('/', function () {
    return view('welcome');
});

// Dashboard Route
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Authenticated User Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('admin/employees', [EmployeeController::class, 'index'])->name('admin.employees.index');
    Route::get('/search/users', [EmployeeController::class, 'searchUsers']);
    Route::get('admin/employees/create', [EmployeeController::class, 'create'])->name('admin.employees.create');
    Route::post('admin/employees', [EmployeeController::class, 'store'])->name('admin.employees.store');
    Route::get('admin/employees/{employee}/edit', [EmployeeController::class, 'edit'])->name('admin.employees.edit');
    Route::patch('admin/employees/{employee}', [EmployeeController::class, 'update'])->name('admin.employees.update');
    Route::delete('admin/employees/{employee}', [EmployeeController::class, 'destroy'])->name('admin.employees.destroy');
    Route::get('admin/employees/{employee}', [EmployeeController::class, 'show'])->name('admin.employees.show');

    // Route to update the employee's approval status
    Route::patch('admin/employees/{employee}/update-status', [EmployeeController::class, 'updateStatus'])->name('admin.employees.updateStatus');
});

// User Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/user/update', [UserController::class, 'edit'])->name('user.update');
    Route::put('/user/update', [UserController::class, 'update'])->name('user.update.process');

 // Cost routes
    Route::get('/user/cost', [UserController::class, 'index'])->name('user.cost'); // Display cost page
    Route::get('/user/appliances', [UserController::class, 'appliances'])->name('user.appliances'); // Display cost page


});
use App\Http\Controllers\WorkPostingController;

// Route for the Work Posting page
Route::get('/user.work-posting', [WorkPostingController::class, 'index'])->name('user.work-posting')->middleware('auth');


// Authentication Routes
require __DIR__.'/auth.php';
