<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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
// Home
// Route::get('/', function () {
//     return view('pages.home.index');
// })->name('home');

// Route::get('/', [HomeController::class, 'index']);
// Route::get('/shop', [ProductController::class, 'index']);
// Route::get('/shop/{id}/{name}/{price}', [ProductController::class, 'show']);
// Shop
// Route::get('/shop', function () {
//     return view('pages.product.index');
// })->name('shop');
// Route::get('/hello', function () {
//     return view('hello');
// })->name('hello');
// Route::get($uri, $callback);

// Route::get('user/{id}/{name}/{comment}', function ($id, $name, $comment) {
//     echo "ID của user là : " . $id;
//     echo "<br>Tên của user là : " . $name;
//     echo "<br> Comment của user: " . $comment;
// })->name('user.welcome');

// $url = route('user.welcome', ['id' => "1"]);
// url : Đường dẫn website 
// callback : function để truyền dự liệu 

Route::get('/', [UserController::class, 'index'])->name('users.index');
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
Route::get('/users/edit/{user}', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/update/{user}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/delete/{user}', [UserController::class, 'destroy'])->name('users.destroy');
Route::get('/user/{user}', [UserController::class, 'show'])->name('users.show');
