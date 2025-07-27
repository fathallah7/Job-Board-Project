<?php

use App\Http\Controllers\Dashboard;
use App\Http\Controllers\JobVacancyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResumeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', [Dashboard::class, 'index'])->name('dashboard');

Route::get('/job-vacancies-info/{id}' , [JobVacancyController::class , 'show'])->name('job-vacancies-show');
Route::get('/job-vacancies-info/{id}/apply' , [JobVacancyController::class , 'apply'])->name('job-vacancies-apply');

Route::post('/resume/upload/{id}', [JobVacancyController::class, 'store'])->name('resume.upload');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
