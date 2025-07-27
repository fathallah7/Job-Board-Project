<?php

namespace App\Http\Controllers;

use App\Models\JobVacancy;
use Illuminate\Http\Request;

class JobVacancyController extends Controller
{
    public function show($id) {
        $job = JobVacancy::findOrFail($id);
        return view('job-vacancy.show' , compact('job')); 
    }
}
