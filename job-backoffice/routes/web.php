<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\JobCategoryController;
use App\Http\Controllers\JobVacancyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\Company;
use App\Models\JobVacancy;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::middleware(["auth", "role:admin,company_owner"])->group(function () {

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Job Vacancies
    Route::resource('/job-vacancies', JobVacancyController::class);
    Route::put('/job-vacancies/{id}/restore', [JobVacancyController::class, 'restore'])->name('vacancies.restore');

    // Job Application
    Route::resource('/job-applications', JobApplicationController::class);
    Route::put('/job-applications/{id}/restore', [JobApplicationController::class, 'restore'])->name('job-applications.restore');

    // Admin Routes
    Route::middleware(["auth", "role:admin"])->group(function () {
        // Companies
        Route::resource('/companies', CompanyController::class);
        Route::put('/companies/{id}/restore', [CompanyController::class, 'restore'])->name('companies.restore');
        // Categories
        Route::resource('/job-categories', JobCategoryController::class);
        Route::put('/job-categories/{id}/restore', [JobCategoryController::class, 'restore'])->name('categories.restore');
        // Users
        Route::resource('/users', UserController::class);
        Route::put('/users/{id}/restore', [UserController::class, 'restore'])->name('users.restore');
    });

    // Company-Owner Routes
    Route::middleware(["auth", "role:company_owner"])->group(function () {
        Route::get('/my-company', [CompanyController::class, 'show'])->name('my-company.show');
        Route::get('/my-company/edit', [CompanyController::class, 'edit'])->name('my-company.edit');
        Route::put('/my-company', [CompanyController::class, 'update'])->name('my-company.update');
    });

});

require __DIR__ . '/auth.php';
