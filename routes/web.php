<?php

use App\Http\Controllers\IndexController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {

//    alt + enter
//    $users = User::query()
//        ->where('role', '=', 'admin')
//        ->orWhere('email', '=', 'juliane@bk.ru')
//        ->get();

//    Создание пользователя
//    $user = User::query()->create([
//        'username' => 'username' . uniqid(),
//        'email' => uniqid() . '@gmail.com',
//        'password' => Hash::make('forge')
//    ]);

//    Обновление данных
//    User::query()->find(2)->update([
//       'username' => 'Poi$$ion Girl'
//    ]);

//    dd();
    return view('welcome');
});

Route::get('/home', function (){
   return view('home');
});

//Route::get('/',  [\App\Http\Controllers\IndexController::class, 'home']);
//or
//Route::controller(IndexController::class)->group(function() {
//    Route::get('/', 'home');
//});



Route::controller(IndexController::class)->group(function (){
   Route::get('/', 'home')->name('home');
   Route::get('/signup', 'signup');
   Route::get('/signin', 'signin');
});

//Route::controller(\App\Http\Controllers\AuthController::class)->group(function(){
//    Route::post('/auth/signup', 'signup')->name('auth.signup');
//
//    Route::get('/auth/logout');
//});
//OR!!!
Route::controller(\App\Http\Controllers\AuthController::class)->prefix('/auth')->as('auth.')->group(function(){
    Route::post('/signup', 'signup')->name('signup');

    Route::get('/logout', 'logout')->name('logout') ;
});
