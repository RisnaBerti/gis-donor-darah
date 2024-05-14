<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\{
    HomeController,
    UserController,
    ProfileController,
    RolesController,    
    PendonorController,
    PencariController,
    StokDarahController,
};

use App\Http\Controllers\UserPanel\{
    PanelController,
    OrderController,
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

        Route::resource('users', UserController::class);

        // Route Pendonor 
        Route::get('pendonors', [PendonorController::class, 'index'])->name('pendonors.index');
        Route::get('pendonors/create', [PendonorController::class, 'create'])->name('pendonors.create');
        Route::post('pendonors/store', [PendonorController::class, 'store'])->name('pendonors.store');
        Route::get('pendonors/{user}', [PendonorController::class, 'show'])->name('pendonors.show');
        Route::get('pendonors/{user}/edit', [PendonorController::class, 'edit'])->name('pendonors.edit');
        Route::put('pendonors/{user}', [PendonorController::class, 'update'])->name('pendonors.update');
        Route::delete('pendonors/{user}', [PendonorController::class, 'destroy'])->name('pendonors.destroy');
        Route::get('pendonors/{user}/riwayat', [PendonorController::class, 'riwayat'])->name('pendonors.riwayat');
        Route::post('pendonors/addriwayat', [PendonorController::class, 'storeRiwayat'])->name('pendonors.addRiwayat');

        // Route Pencari Donor
        Route::get('pencaris', [PencariController::class, 'index'])->name('pencaris.index');
        Route::get('pencaris/create', [PencariController::class, 'create'])->name('pencaris.create');
        Route::post('pencaris/store', [PencariController::class, 'store'])->name('pencaris.store');
        Route::get('pencaris/{user}', [PencariController::class, 'show'])->name('pencaris.show');
        Route::get('pencaris/{user}/edit', [PencariController::class, 'edit'])->name('pencaris.edit');
        Route::put('pencaris/{user}', [PencariController::class, 'update'])->name('pencaris.update');
        Route::delete('pencaris/{user}', [PencariController::class, 'destroy'])->name('pencaris.destroy');

        // Route Stok Darah
        Route::get('stokdarahs', [StokDarahController::class, 'index'])->name('stokdarah.index');
        Route::get('stokdarahs/create', [StokDarahController::class, 'create'])->name('stokdarah.create');
        Route::post('stokdarahs/store', [StokDarahController::class, 'store'])->name('stokdarah.store');
        Route::get('stokdarahs/{stokdarah}', [StokDarahController::class, 'show'])->name('stokdarah.show');
        Route::get('stokdarahs/{stokdarah}/edit', [StokDarahController::class, 'edit'])->name('stokdarah.edit');
        Route::put('stokdarahs/{stokdarah}', [StokDarahController::class, 'update'])->name('stokdarah.update');
        Route::delete('stokdarahs/{stokdarah}', [StokDarahController::class, 'destroy'])->name('stokdarah.destroy');
        Route::put('stokdarahs/{stokdarah}', [StokDarahController::class, 'updateStok'])->name('stokdarah.updatestok');

        Route::get('profile', [ProfileController::class, 'index'])->name('profile');
        Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');

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
    Route::get('/stokdarah', [PanelController::class, 'stokDarah'])->name('stokdarah');
    Route::get('/profile', [PanelController::class, 'profile'])->name('panel.profile');

    Route::get('/cari', [OrderController::class, 'index'])->name('cari');
    Route::get('/cari/donor', [OrderController::class, 'search'])->name('cari.donor');
    Route::post('/request', [OrderController::class, 'order'])->name('store.order');

});

