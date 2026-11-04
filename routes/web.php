<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\AbsensiController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/mata-kuliah', [MataKuliahController::class, 'index'])->name('matkul.index');
Route::get('/mata-kuliah/create', [MataKuliahController::class, 'create'])->name('matkul.create');
Route::post('/mata-kuliah', [MataKuliahController::class, 'store'])->name('matkul.store');
Route::get('/mata-kuliah/{id}/edit', [MataKuliahController::class, 'edit'])->name('matkul.edit');
Route::put('/mata-kuliah/{id}', [MataKuliahController::class, 'update'])->name('matkul.update');
Route::delete('/mata-kuliah/{id}', [MataKuliahController::class, 'destroy'])->name('matkul.destroy');

Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.index');
Route::get('/mahasiswa/create', [MahasiswaController::class, 'create'])->name('mahasiswa.create');
Route::post('/mahasiswa', [MahasiswaController::class, 'store'])->name('mahasiswa.store');
Route::get('/mahasiswa/{id}/edit', [MahasiswaController::class, 'edit'])->name('mahasiswa.edit');
Route::put('/mahasiswa/{id}', [MahasiswaController::class, 'update'])->name('mahasiswa.update');
Route::delete('/mahasiswa/{id}', [MahasiswaController::class, 'destroy'])->name('mahasiswa.destroy');

Route::get('/absensi', [AbsensiController::class, 'index'])->name('absensi.index');
Route::get('/absensi/create', [AbsensiController::class, 'create'])->name('absensi.create');
Route::post('/absensi', [AbsensiController::class, 'store'])->name('absensi.store');
