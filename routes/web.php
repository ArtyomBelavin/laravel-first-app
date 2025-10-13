<?php

use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/reports', function () {
//     return view('report.index');
// })->name('reports.index');

Route::get('/reports', [ReportController::class, 'index'])->name('report.index');

Route::get('/reports/create', function () {
    return view('report.create');
})->name('reports.create');


Route::delete('/reports/{report}', [ReportController::class, 'destroy'])->name('report.destroy');

Route::post('/reports', [ReportController::class, 'store'])->name('report.store');

Route::get('/reports/{report}/edit', [ReportController::class, 'edit'])->name('reports.edit');
Route::put('/reports/{report}', [ReportController::class, 'update'])->name('reports.update');
