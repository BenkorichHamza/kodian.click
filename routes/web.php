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
    $packageName = 'com.benkosoft.kodian'; // ضع معرف الباكيج الخاص بتطبيقك
    $playStoreUrl = "https://play.google.com/store/apps/details?id={$packageName}";

    $intentUrl = "intent://#Intent;package={$packageName};scheme=https;end;";

    return redirect($intentUrl);
});

require __DIR__.'/auth.php';
