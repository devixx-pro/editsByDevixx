<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/case-studies/fintruction', function () {
    return view('case-studies.fintruction');
})->name('case-studies.fintruction');

Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');
