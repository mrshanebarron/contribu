<?php

use App\Http\Controllers\ContributionController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RsvpController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/how-it-works', [PageController::class, 'howItWorks'])->name('how-it-works');
Route::get('/create-registry', [PageController::class, 'createRegistry'])->name('create-registry');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');

// Wedding pages
Route::get('/wedding/{slug}', [PageController::class, 'wedding'])->name('wedding');
Route::get('/wedding/{slug}/gift/{gift}', [PageController::class, 'gift'])->name('gift');
Route::post('/wedding/{slug}/gift/{gift}/contribute', [ContributionController::class, 'store'])->name('contribute');
Route::get('/wedding/{slug}/rsvp', [PageController::class, 'rsvp'])->name('rsvp');
Route::post('/wedding/{slug}/rsvp', [RsvpController::class, 'store'])->name('rsvp.store');
