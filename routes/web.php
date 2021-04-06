<?php

use App\Http\Controllers\pasteController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

Route::get('/mypaste', 'pasteController@UserCont')->name('mypaste');

Route::get('/login', function () {
    if(Auth::check()){return redirect(route('main'));} //а может пользователь уже залогинился

    return view('login');
})->name('login');
Route::post('/login', 'LoginController@login')->name('login');


Route::get('/reg', function () {
    if(Auth::check()){return redirect(route('main'));} //а может пользователь уже залогинился
    return view('reg');
})->name('reg');

Route::post('/reg', 'LoginController@reg')->name('reg');
Route::get('/logout', 'LoginController@logout')->name('logout');


Route::get('/', 'pasteController@MainCont')->name('main');


Route::get('/add', function () {
    return view('add');
})->name('add');

Route::post('/add', 'pasteController@submitPaste')->name('add');


Route::get('/about', function () {

    return view('about');
})->name('about');

Route::get('/{alias}', 'pasteController@viewPasta')->name('alias');


