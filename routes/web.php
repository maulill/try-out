<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// redirect otomatis sesuai role
Route::get('/dashboard', function () {
    $user = auth()->user();

    if ($user->role === 'admin') {
        return redirect('/admin/dashboard');
    } elseif ($user->role === 'guru') {
        return redirect('/guru/dashboard');
    } else {
        return redirect('/siswa/dashboard');
    }
})->middleware(['auth'])->name('dashboard');


// Dashboard Admin
Route::get('/admin/dashboard', function () {
    return view('dashboard.admin');
})->middleware(['auth'])->name('admin.dashboard');


// Dashboard Guru
Route::get('/guru/dashboard', function () {
    return view('dashboard.guru');
})->middleware(['auth'])->name('guru.dashboard');


// Dashboard Siswa  ← (INI YANG SALAH TADI)
Route::get('/siswa/dashboard', function () {
    return view('dashboard.siswa');
})->middleware(['auth'])->name('siswa.dashboard');


// Profile (default Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
