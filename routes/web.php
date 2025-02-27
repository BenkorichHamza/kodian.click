<?php

use Illuminate\Support\Facades\Route;
Route::get('/', function () {
    return view('Home');
});

Route::get('/privacy-policy', function () {
    return view('Politique');
});
Route::get('/helpme', function () {
    return view('Help');
});

Route::get('/download', function () {
   return redirect("https://play.google.com/store/apps/details?id=com.benkosoft.kodian&hl=fr");
});

require __DIR__.'/auth.php';
