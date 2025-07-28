<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobVacancyResumeRequest;
use App\Models\JobApplication;
use App\Models\JobVacancy;
use App\Models\Resume;
use Illuminate\Http\Request;
use Str;

class JobVacancyController extends Controller
{
    public function show($id)
    {
        $job = JobVacancy::findOrFail($id);
        $hasApplied = JobApplication::where('job_vacancy_id' , $id)->where('user_id' , auth()->user()->id)->exists();
        return view('job-vacancy.show', compact('job' , 'hasApplied'));
    }

    public function apply(string $id)
    {
        $job = JobVacancy::findOrFail($id);

        $hasApplied = JobApplication::where('job_vacancy_id' , $id)->where('user_id' , auth()->user()->id)->exists();
        if($hasApplied) {
            return redirect()->route('job-vacancies-show' , $id);
        }

        return view('job-vacancy.apply', compact('job'));
    }


    public function store(JobVacancyResumeRequest $request, string $id)
    {

        $request->validate([
            'resume' => 'required|mimes:pdf|max:2048',
        ]);

        // 1. upload the file
        $file = $request->file('resume');
        $filename = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('resumes', $filename, 'public');

        // 2. store data
        $resume = Resume::create([
            'fileName' => $filename,
            'fileUrl' => '/storage/' . $filePath,
            'user_id' => auth()->user()->id,
            'contactDetails' => 'Soon on AI Update',
            'education' => 'Soon on AI Update',
            'skills' => 'Soon on AI Update',
            'experience' => 'Soon on AI Update',
            'summary' => 'Soon on AI Update',
        ]);

        // 3. store data
        JobApplication::create([
            'user_id' => auth()->user()->id,
            'job_vacancy_id' => $id,
            'resume_id' => $resume->id,
            'status' => 'pending',

            // Fake AI response
            'aiGeneratedScore' => rand(0, 10),
            'aiGeneratedFeedback' => 'This candidate shows good experience in the field but needs improvement in soft skills.',
        ]);

        //  in future ai

        return redirect()->route('job-vacancies-show' , $id)->with('success', 'Your application has been submitted successfully!');
    }
}
