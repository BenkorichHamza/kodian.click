<?php

use Illuminate\Support\Facades\Route;
Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

Route::get('/privacy-policy', function () {
    return view('Politique');
});
Route::get('/helpme', function () {
    return view('Help');
});

require __DIR__.'/auth.php';
