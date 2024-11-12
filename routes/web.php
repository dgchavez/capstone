<?php
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\VetController;
use App\Http\Controllers\ReceptionistController;
use App\Http\Livewire\Pages\Auth\Register;

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'admin']) //0
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('/owner/dashboard',[OwnerController::class,'loadOwnerDashboard'])
->name('owner-dashboard')
->middleware('owner');

Route::get('/vet/dashboard',[VetController::class,'loadVetDashboard'])
->name('vet-dashboard')
->middleware('vet');

Route::get('/receptionist/dashboard',[ReceptionistController::class,'loadReceptionistDashboard'])
->name('receptionist-dashboard')
->middleware('receptionist');

require __DIR__.'/auth.php';
