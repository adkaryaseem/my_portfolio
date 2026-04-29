<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\CertificationController;

Route::get('/', [PortfolioController::class, 'index'])->name('portfolio.index');
Route::post('/contact', [PortfolioController::class, 'sendMessage'])->name('contact.send')->middleware('throttle:10,1');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5,1');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/settings', [AdminController::class, 'settings'])->name('admin.settings');
    Route::post('/settings', [AdminController::class, 'updateSettings'])->name('admin.settings.update');
    Route::post('/change-password', [AdminController::class, 'updatePassword'])->name('admin.password.update');
    Route::get('/messages', [AdminController::class, 'messages'])->name('admin.messages');
    Route::post('/messages/{id}/read', [AdminController::class, 'markMessageRead'])->name('admin.messages.read');
    Route::post('/messages/{id}/reply', [AdminController::class, 'replyMessage'])->name('admin.messages.reply');

    Route::resource('projects', ProjectController::class, ['as' => 'admin']);
    Route::resource('skills', SkillController::class, ['as' => 'admin']);
    Route::resource('experiences', ExperienceController::class, ['as' => 'admin']);
    Route::resource('certifications', CertificationController::class, ['as' => 'admin']);
});
