<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\JobCategoryController;
use App\Http\Controllers\JobVacancyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\Company;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::middleware('auth')->group(function () {

    Route::get('/' , [DashboardController::class,'index'])->name('dashboard');
    
    Route::resource('/companies' , CompanyController::class);
    Route::put('/companies/{id}/restore' , [CompanyController::class,'restore'])->name('companies.restore');

    Route::resource('/job-applications' , JobApplicationController::class);
    Route::resource('/job-categories' , JobCategoryController::class);
    Route::resource('/job-vacancies' , JobVacancyController::class);
    Route::resource('/users' , UserController::class);


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
