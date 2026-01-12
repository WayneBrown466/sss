<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VenueController;

Route::get('/', [VenueController::class, 'index'])->name('venues.index');
Route::get('/venues/create', [VenueController::class, 'create'])->name('venues.create');
Route::post('/venues', [VenueController::class, 'createNewVenue'])->name('venues.createNewVenue');
Route::get('/venues/{id}', [VenueController::class, 'show'])->name('venues.show');
Route::get('/venues/{id}/edit', [VenueController::class, 'edit'])->name('venues.edit');
Route::delete('/venues/{id}', [VenueController::class, 'delete'])->name('venues.delete');

