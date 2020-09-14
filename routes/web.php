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

Route::get('say', [App\Http\Controllers\Auth\TestMe::class, 'say']);

Route::get('/', function () {
    return view('welcome');
});


Route::post('/kontakt',[App\Http\Controllers\ContactController::class, 'handle_form']);

// Alternative: Route::view('/kontakt', 'contact');
Route::get('/kontakt',function() {
	return view('contact');
});
Route::get('/impressum',function() {
	return 'impressum';
});
Route::get('/datenschutz',function() {
	return 'datenschutz';
});


Auth::routes();
Route::get('oauth/{driver}', [App\Http\Controllers\Auth\OAuthController::class, 'redirectToProvider']);
Route::get('auth/callback/{driver}', 'App\Http\Controllers\Auth\OAuthController@handleProviderCallback')->name('oauth.callback'); 
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
