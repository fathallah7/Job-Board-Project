<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use Illuminate\Http\Request;

class UserApplication extends Controller
{
    public function index()
    {
        $applications = JobApplication::with(['jobVacancy'])
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('job-application.my', compact('applications'));
    }

    public function destroy($id)
    {
        JobApplication::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Application canceled successfully.');
    }
}
