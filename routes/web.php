<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CriteriaController;
use App\Http\Controllers\RatingCriteriaController;
use App\Http\Controllers\UniversityController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');


/* Route::prefix('auth')->group(function () {
    // Routes pour les utilisateurs non authentifiés
    Route::middleware('guest')->group(function () {
        Route::get('register', [AccountController::class, 'showRegistrationForm'])->name('auth.registerForm');
        Route::post('register', [AccountController::class, 'register'])->name('auth.register');
        Route::get('login', [AccountController::class, 'showLoginForm'])->name('auth.loginForm');
        Route::post('login', [AccountController::class, 'login'])->name('auth.login');
    });

    // Routes pour les utilisateurs authentifiés
    Route::middleware('auth')->group(function () {
        Route::get('profile', [AccountController::class, 'ProfileView'])->name('auth.profileView');
    });
}); */

// Route::resource('homes',  HomeController::class);
/* Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/university/{university}/show', 'show')->name(('universities.detail'));
}); */


// Route::resource('universities', UniversityController::class);

Route::middleware('guest')->prefix('auth')->group(function () {
    Route::get('register', [AccountController::class, 'showRegistrationForm'])->name('auth.registerForm');
    Route::post('register', [AccountController::class, 'register'])->name('auth.register');
    Route::get('login', [AccountController::class, 'showLoginForm'])->name('auth.loginForm');
    Route::post('login', [AccountController::class, 'login'])->name('auth.login');
});

Route::middleware('auth')->prefix('auth')->group(function () {
    Route::get('profile', [AccountController::class, 'ProfileView'])->name('auth.profileView');
    Route::get('logout', [AccountController::class, 'logout'])->name('auth.logout');
    Route::post('update-profile', [AccountController::class, 'updateProfile'])->name('auth.updateProfile');
    Route::get('update-password/edit', [AccountController::class, 'showChangePasswordForm'])->name('auth.updatePasswordView');
    Route::put('update-password', [AccountController::class, 'updatePassword'])->name('auth.updatePassword');

    Route::controller(UniversityController::class)->group(function () {
        /* Route::get('universities',  'index')->name('universities.index');
        Route::get('universities/create',  'create')->name('universities.create');
        Route::post('universities', 'store')->name('universities.store');
        Route::get('universities/{id}/edit', 'edit')->name('universities.edit');
        Route::post('universities/{id}', 'update')->name('universities.update');
        Route::delete('universities/{id}', 'destroy')->name('universities.destroy'); */
        Route::get('universities/rankings', 'rankings')->name('universities.rankings');
        Route::get('universities/list', 'listUniversities')->name('universities.list');
    });

    Route::resources([
        'universities' => UniversityController::class,
        'users' => UserController::class,
        'criterias' => CriteriaController::class,
        'comments' => CommentController::class,
        'ratings' => RatingController::class,
        'ratingsCriterias' => RatingCriteriaController::class,
    ]);

});
