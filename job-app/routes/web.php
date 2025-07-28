<?php

use App\Http\Controllers\Dashboard;
use App\Http\Controllers\JobVacancyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\UserApplication;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'role:job_seeker'])->group(function () {

    Route::get('/dashboard', [Dashboard::class, 'index'])->name('dashboard');

    Route::get('/my-applications', [UserApplication::class, 'index'])->name('applications');
    Route::delete('/job-applications/{id}', [UserApplication::class, 'destroy'])->name('applications.destroy');


    Route::get('/job-vacancies-info/{id}', [JobVacancyController::class, 'show'])->name('job-vacancies-show');
    Route::get('/job-vacancies-info/{id}/apply', [JobVacancyController::class, 'apply'])->name('job-vacancies-apply');
    Route::post('/job-vacancies-info/resume/upload/{id}', [JobVacancyController::class, 'store'])->name('resume.upload');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
