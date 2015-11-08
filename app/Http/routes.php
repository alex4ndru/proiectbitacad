<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
Route::get('/', function () {
    return view('pages.home');
});

Route::get('info', 'info@showInfo');
Route::get('petitii', 'petitii@showPetitii');
Route::get('taxe', 'taxe@showTaxe');
Route::get('alegeri', 'alegeri@showalegeri');
*/

Route::get('/', 'Page@serveHome');
Route::get('info', 'Page@serveInfo');
Route::get('petitii', 'Page@servePetitii');
    Route::get('petitii/new', 'Page@servePetitiiNew');
    Route::post('petitii/new', 'Page@servePetitiiNewSave');
    Route::get('petitions/{id}', 'Page@servePetitiiDetails');
    Route::post('petitions/vote/for/{id}', 'Page@servePetitiiVoteFor');
    Route::post('petitions/vote/against/{id}', 'Page@servePetitiiVoteAgainst');
Route::get('taxe', 'Page@serveTaxe');
Route::get('alegeri', 'Page@serveAlegeri');
Route::get('/contact', 'Page@serveContact');
Route::get('/help', 'Page@serveHelp');
Route::get('/city', 'Page@serveCity');

Route::controllers([
   'auth' => 'Auth\AuthController',
   'password' => 'Auth\PasswordController',
]);
