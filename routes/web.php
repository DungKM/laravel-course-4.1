<?php

use App\Http\Controllers\GithubController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Google\Client;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
Route::get('/users/edit/{user}', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/update/{user}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/delete/{user}', [UserController::class, 'destroy'])->name('users.destroy');
Route::get('/user/{user}', [UserController::class, 'show'])->name('users.show');

Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
// Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
Route::get('/auth/google/callback', function () {
    $code = request('code');

    if ($code) {
        $client = new Client();
        $client->setClientId(config('services.google.client_id'));
        $client->setClientSecret(config('services.google.client_secret'));
        $client->setRedirectUri(config('services.google.redirect'));

        $token = $client->fetchAccessTokenWithAuthCode($code);

        if (isset($token['access_token'])) {
            file_put_contents(storage_path('app/google/token.json'), json_encode($token));
            return "Token đã được lưu thành công!";
        }

        return "Không thể lấy token.";
    }

    return "Không tìm thấy mã xác thực!";
});
Route::get('auth/github', [GithubController::class, 'redirectToGithub'])->name('github.login');
Route::get('auth/git/callback', [GithubController::class, 'handleGithubCallback']);
require __DIR__ . '/auth.php';