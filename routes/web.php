<?php

use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Admin\SocialSettingsController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RobotsController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;

Route::get('/robots.txt', RobotsController::class);
Route::get('/sitemap.xml', SitemapController::class);

Route::get('/locale/{locale}', [LocaleController::class, 'switch'])->name('locale.switch');

Route::redirect('/favicon.ico', '/assets/img/favicon-round.png');

Route::get('/', HomeController::class)->name('home');
Route::get('/project/{project:slug}', [ProjectController::class, 'show'])->name('project.show');

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return redirect()->route('admin.projects.index');
    })->name('dashboard');
    Route::get('/social', [SocialSettingsController::class, 'edit'])->name('social.edit');
    Route::put('/social', [SocialSettingsController::class, 'update'])->name('social.update');
    Route::resource('projects', AdminProjectController::class)->except(['show']);
});

Route::get('/dashboard', function () {
    return redirect()->route('admin.projects.index');
})->middleware('auth')->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
