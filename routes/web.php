<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'pasteController@MainCont')->name('main');


Route::get('/pasteadd', function () {
    return view('pasteadd');
})->name('pasteadd');

Route::post('/add', 'pasteController@submitPaste')->name('pasteadd2');


Route::get('/about', function () {

    return view('about');
})->name('about');

Route::get('/{alias}', 'pasteController@viewPasta')->name('alias');


