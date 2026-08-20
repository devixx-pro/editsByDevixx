<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContentToolController;
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

Route::get('/meta-ads-workbook', function () {
    return view('lead-magnets.meta-ads-workbook');
})->name('lead-magnets.meta-ads-workbook');

Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

// Internal multi-company Content Tool. Password-gated, noindex, not in the sitemap.
//   /content-tool            -> login, then company picker
//   /content-tool/{company}  -> the gate tool for one company (e.g. fuelcfo)
Route::prefix('content-tool')->group(function () {
    Route::get('/', [ContentToolController::class, 'index'])->name('content-tool');
    Route::post('/login', [ContentToolController::class, 'login'])->name('content-tool.login');
    Route::post('/logout', [ContentToolController::class, 'logout'])->name('content-tool.logout');
    Route::get('/{company}', [ContentToolController::class, 'company'])->name('content-tool.company');
    Route::post('/{company}/api', [ContentToolController::class, 'api'])->name('content-tool.api');
});
