<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/case-studies/fintruction', function () {
    return view('case-studies.fintruction');
})->name('case-studies.fintruction');

Route::get('/case-studies/accrivo', function () {
    return view('case-studies.accrivo');
})->name('case-studies.accrivo');

Route::get('/ground-zero', function () {
    return view('lead-magnets.ground-zero');
})->name('lead-magnets.ground-zero');

Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');
