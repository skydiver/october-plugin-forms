<?php

use Illuminate\Support\Facades\Route;

Route::namespace('Martin\Forms\Classes\FilePond')
    ->prefix('martin/forms')
    ->group(function () {
        Route::post('/process', 'FilePondController@upload')->name('filepond.upload');
        Route::delete('/process', 'FilePondController@delete')->name('filepond.delete');
    });
