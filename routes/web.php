<?php

use Illuminate\Support\Facades\Route;
Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

Route::get('/politique', function () {
    return "aaaa";
});

require __DIR__.'/auth.php';
