<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/reports', function () {
    return view('report.index');
})->name('reports.index');

Route::get('/reports/create', function () {
    return view('report.create');
})->name('reports.create');
