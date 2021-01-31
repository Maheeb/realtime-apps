<?php

use Illuminate\Support\Facades\Artisan;
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

Route::get('/home', 'HomeController@index')->name('home');

Route::view('users', 'users.showAll')->name('users.all');

Route::view('/game', 'game.show')->name('game.show');

// Route::get('start', function () {
//     Artisan::call('game:execute');

//     // sleep(30);

//     return 'Game execution has started';
// });


Route::get('/chat','ChatController@showChat')->name('chat.show');
Route::post('/chat/message', 'ChatController@messageReceived')->name('chat.message');
