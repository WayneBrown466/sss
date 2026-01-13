<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\VenueController;

Route::get('/', [EventController::class, 'index'])->name('events.index');
Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
Route::post('/events', [EventController::class, 'createNewEvent'])->name('events.createNewEvent');
Route::get('/events/{id}', [EventController::class, 'show'])->name('events.show');
Route::get('/events/{id}/edit', [EventController::class, 'edit'])->name('events.edit');
Route::put('/events/{id}', [EventController::class, 'update'])->name('events.update');
Route::delete('/events/{id}', [EventController::class, 'delete'])->name('events.delete');

Route::get('/venues', [VenueController::class, 'index'])->name('venues.index');
Route::get('/venues/create', [VenueController::class, 'create'])->name('venues.create');
Route::post('/venues', [VenueController::class, 'createNewVenue'])->name('venues.createNewVenue');
Route::get('/venues/{id}', [VenueController::class, 'show'])->name('venues.show');
Route::get('/venues/{id}/edit', [VenueController::class, 'edit'])->name('venues.edit');
Route::put('/venues/{id}', [VenueController::class, 'update'])->name('venues.update');
Route::delete('/venues/{id}', [VenueController::class, 'delete'])->name('venues.delete');