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

Auth::routes();

Route::get('/verificacion', function (){
    return view('auth.verify');
});

Route::get('/sesiones', function (){
    return view('auth.sesion');
});

// 2fa middleware
Route::middleware(['2fa'])->group(function () {

    // HomeController
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::post('/2fa', function () {
        return redirect(route('home'));
    })->name('2fa')->middleware(['verificacion','sesiones']);

});

Route::get('/complete-registration', [App\Http\Controllers\Auth\RegisterController::class, 'completeRegistration'])
->name('complete.registration');

