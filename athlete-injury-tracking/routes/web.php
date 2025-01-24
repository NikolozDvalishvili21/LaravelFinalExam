<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AthleteController;
use App\Http\Controllers\InjuryController;
use App\Http\Controllers\TreatmentController;

// Athlete Routes
Route::get('athletes', [AthleteController::class, 'index'])->name('athletes.index');
Route::post('athletes', [AthleteController::class, 'store'])->name('athletes.store');
Route::get('athletes/{id}', [AthleteController::class, 'show'])->name('athletes.show');
Route::put('athletes/{id}', [AthleteController::class, 'update'])->name('athletes.update');
Route::delete('athletes/{id}', [AthleteController::class, 'destroy'])->name('athletes.destroy');

// Injury Routes
Route::get('injuries', [InjuryController::class, 'index'])->name('injuries.index');
Route::post('injuries', [InjuryController::class, 'store'])->name('injuries.store');
Route::get('injuries/{id}', [InjuryController::class, 'show'])->name('injuries.show');
Route::put('injuries/{id}', [InjuryController::class, 'update'])->name('injuries.update');
Route::delete('injuries/{id}', [InjuryController::class, 'destroy'])->name('injuries.destroy');

// Treatment Routes
Route::get('treatments', [TreatmentController::class, 'index'])->name('treatments.index');
Route::post('treatments', [TreatmentController::class, 'store'])->name('treatments.store');
Route::get('treatments/{id}', [TreatmentController::class, 'show'])->name('treatments.show');
Route::put('treatments/{id}', [TreatmentController::class, 'update'])->name('treatments.update');
Route::delete('treatments/{id}', [TreatmentController::class, 'destroy'])->name('treatments.destroy');

