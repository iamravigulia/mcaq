<?php
use Illuminate\Support\Facades\Route;

// Route::get('greeting', function () {
//     return 'Hi, this is your awesome package! Mcaq';
// });

// Route::get('picmatch/test', 'EdgeWizz\Picmatch\Controllers\PicmatchController@test')->name('test');

Route::post('fmt/mcaq/store', 'EdgeWizz\Mcaq\Controllers\McaqController@store')->name('fmt.mcaq.store');

Route::post('fmt/mcaq/csv', 'EdgeWizz\Mcaq\Controllers\McaqController@csv_upload')->name('fmt.mcaq.csv');

Route::post('fmt/mcaq/update/{id}', 'EdgeWizz\Mcaq\Controllers\McaqController@edit')->name('fmt.mcaq.update');

Route::any('fmt/mcaq/inactive/{id}',  'EdgeWizz\Mcaq\Controllers\McaqController@inactive')->name('fmt.mcaq.inactive');
Route::any('fmt/mcaq/active/{id}',  'EdgeWizz\Mcaq\Controllers\McaqController@active')->name('fmt.mcaq.active');