<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\{
    HomeController,
    UserController,
    ProfileController,
    RolesController
};


Route::get('/', function () {
    if (auth()->check()) {
        return auth()->user()->hasRole('admin') ? redirect()->route('dashboard') : redirect()->route('home');
    } else {
        return view('welcome');
    }
});

Auth::routes();

Route::middleware(['auth', 'web'])->group(function () {
    //Admin routes
    Route::middleware(['role:admin'])->prefix('admin')->group(function () {
        Route::get('/', [HomeController::class, 'index'])->name('dashboard');
        Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

        Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
        Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

        Route::get('roles', [RolesController::class, 'index'])->name('roles.index');
        Route::get('roles/create', [RolesController::class, 'create'])->name('roles.create');
        Route::post('roles/store', [RolesController::class, 'store'])->name('roles.store');
        Route::get('roles/{role}', [RolesController::class, 'show'])->name('roles.show');
        Route::get('roles/{role}/edit', [RolesController::class, 'edit'])->name('roles.edit');
        Route::put('roles/{role}', [RolesController::class, 'update'])->name('roles.update');
        Route::delete('roles/{role}', [RolesController::class, 'destroy'])->name('roles.destroy');
    });

    // User Routes
    Route::get('/home', [PanelController::class, 'index'])->name('home');
});

