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


Route::get('/', 'ApartmentController@index')->name('home');
Route::view('/about', 'about')->name('about');
Route::any('/search', 'SearchController@index')->name('search.index');
Route::get('/apartment/{apartment}', 'ApartmentController@show')->name('apartment.show');
Route::post('/guest/messages', 'MessageController@store')->name('guest.message.store');


Auth::routes();

Route::name('upr.')->prefix('upr')->namespace('Upr')->middleware('auth')->group(function () {
    Route::get('/dashboard', 'HomeController@index')->name('dashboard');
    Route::resource('apartments', 'ApartmentController');
    Route::get('/apartment/{apartment}', 'ApartmentController@show2')->name('apartment.show2');
    Route::any('/apartment/statistics/{apartment}', 'ApartmentController@statistics')->name('apartment.statistics');
    Route::resource('images', 'ImageController');
    Route::post('delete', 'ImageController@deleteImage');
    Route::resource('message', 'MessageController');
    Route::post('payment/{apartment}', 'PaymentController@process')->name('payment.process');
    Route::post('payment/confirmation/{apartment}', 'PaymentController@confirmation')->name('payment.confirmation');

});
