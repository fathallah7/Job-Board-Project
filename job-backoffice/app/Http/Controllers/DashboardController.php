<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\JobApplication;
use App\Models\JobVacancy;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {

        // Companie Count
        $companies = Company::whereNull('deleted_at')->count();

        // Applications Count
        $applications = JobApplication::whereNull('deleted_at')->count();
        $acceptedApplications = JobApplication::where('status', 'accepted')->count();
        $pendingApplications = JobApplication::where('status', 'pending')->count();
        $rejectedApplications = JobApplication::where('status', 'rejected')->count();

        // Vacancies Count
        $jobs = JobVacancy::whereNull('deleted_at')->count();

        // Users Count
        $users = User::whereNull('deleted_at')->count();

        // Active Users Count
        $activeUsers = User::where('last_login_at', '>=', now()->subDay())->where('role', 'job_seeker')->count();

        $analytics = [
            'companies' => $companies,
            'applications' => $applications,
            'jobs' => $jobs,
            'users' => $users,
            'acceptedApplications' => $acceptedApplications,
            'pendingApplications' => $pendingApplications,
            'rejectedApplications' => $rejectedApplications,
            'activeUsers' => $activeUsers,
        ];

        // Most Applied Jobs
        $mostAppliedJobs = JobVacancy::withCount('jobApplications as count')->whereNull('deleted_at')->orderByDesc('count')->limit(5)->get();

        // Conversion Rates
        $conversionRates = JobVacancy::withCount('jobApplications as count')
            ->having('count', '>', 0)->whereNull("deleted_at")->orderByDesc("count")->limit(5)->get()
            ->map(function ($job) {
                if ($job->viewCount > 0) {
                    $job->conversionRate = number_format($job->count / $job->viewCount * 100, 2);
                } else {
                    $job->conversionRate = 0;
                }
                return $job;
            });

        return view("dashboard.index", compact("analytics", "mostAppliedJobs", "conversionRates"));
    }
}
