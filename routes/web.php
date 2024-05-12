<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ResetPasswordController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Backend\PostController as BackendPostController;
use App\Http\Controllers\ImageUploadController;
use App\Http\Controllers\Frontend\PostController as PublicPostController;
use Illuminate\Http\RedirectResponse;

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


Auth::routes();
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::get('/', function () {
    return new RedirectResponse(route('public.posts'));
});
Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// View public post
Route::get('posts', [PublicPostController::class, 'index'])->name('public.posts');
Route::prefix('post')->group(function () {
    Route::get('{slug}', [PublicPostController::class, 'view'])->name('public.post.view');
    Route::get('tag/{slug}', [PublicPostController::class, 'postTag'])->name('public.tag.view');
    Route::get('category/{slug}', [PublicPostController::class, 'viewByCategory'])->name('public.category.view');
    Route::get('reaction/{post_id}/{reaction}', [PublicPostController::class, 'postReaction'])->name('public.reaction.post');
    Route::post('comment', [PublicPostController::class, 'postComment'])->name('public.comment.store');
});

// Authenticated Routes
Route::middleware('auth')->group(function () {
    // Admin Routes
    Route::prefix('admin')->group(function () {
        Route::get('posts', [BackendPostController::class, 'index'])->name('admin.posts');
        Route::get('create', [BackendPostController::class, 'create'])->name('admin.post.create');
        Route::post('store', [BackendPostController::class, 'store'])->name('admin.post.store');
    });
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    Route::post('image', [ImageUploadController::class, 'uploadImage'])->name('upload_image');
});



