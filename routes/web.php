<?php

use App\Http\Controllers\CommentController;
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
   Route::get('/signup', 'signup')->name('signup');
   Route::get('/signin', 'signin')->name('signin');
});

//Route::controller(\App\Http\Controllers\AuthController::class)->group(function(){
//    Route::post('/auth/signup', 'signup')->name('auth.signup');
//
//    Route::get('/auth/logout');
//});
//OR!!!
Route::controller(\App\Http\Controllers\AuthController::class)->prefix('/auth')->as('auth.')->group(function(){
    Route::post('/signup', 'signup')->name('signup');
    Route::post('/signin', 'signin')->name('signin'); // auth.signin
    Route::get('/logout', 'logout')->name('logout') ;
});






Route::controller(\App\Http\Controllers\ArticleController::class)->prefix('/articles')->as('article.')->group(function () {
    Route::middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])->group(function (){
        Route::get('/create', 'createForm')->name('createForm');
        Route::get('/{article:id}/update', 'updateForm')->name('updateForm');
        Route::post('/create', 'store')->name('create');
        Route::get('/{article:id}/delete', 'delete')->name('delete');
        Route::post('/{article:id}/update', 'update')->name('update');
    });


   Route::get('/{article:id}', 'single')->name('single');
});


Route::controller(CommentController::class)
    ->prefix('/comments')
    ->as('comment.')
    ->middleware('auth')
    ->group(function (){
       Route::post('/create', 'store')->name('store');
    });
