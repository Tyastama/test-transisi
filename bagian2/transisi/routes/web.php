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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth:user')->group(function(){
    // Tulis routemu di sini.
  });

Route::resource('companies', CompaniesController::class);
Route::resource('employes', EmployesController::class);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('user/login', 'Auth\UserAuthController@getLogin')->name('user.login');
Route::post('user/login', 'Auth\UserAuthController@postLogin');
