<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CameraController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TemplateController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\PhotoController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\StickerController;
use App\Http\Controllers\Admin\AuthController;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');

// Camera & Capture routes
Route::get('/camera', [CameraController::class, 'index'])->name('camera');
Route::post('/camera/upload', [CameraController::class, 'upload'])->name('camera.upload');
Route::get('/result/{session_code}', [CameraController::class, 'result'])->name('result');
Route::get('/download/{session_code}', [CameraController::class, 'download'])->name('download');

// Gallery
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');
Route::delete('/gallery/{id}', [GalleryController::class, 'destroy'])->name('gallery.destroy');

// Admin Auth Routes
Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

// Admin Protected Routes
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('templates', TemplateController::class);
    Route::resource('events', EventController::class);
    Route::resource('photos', PhotoController::class);
    Route::resource('settings', SettingController::class);
    Route::resource('stickers', StickerController::class);
});
