<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobVacancyCreateRequest;
use App\Http\Requests\JobVacancyUpdateRequest;
use App\Models\JobVacancy;
use App\Models\JobCategory;
use App\Models\Company;
use Illuminate\Http\Request;

class JobVacancyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = JobVacancy::latest();

        if(auth()->user()->role == 'company_owner'){
            $query->where('company_id' , auth()->user()->company->id );
        }

        if (request()->archive) {
            $query->onlyTrashed();
        }

        $vacancies = $query->paginate(10)->onEachSide(1);

        return view("job-vacancy.index", compact("vacancies"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Company::all();
        $categories = JobCategory::all();
        return view("job-vacancy.addform", compact("companies", "categories"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobVacancyCreateRequest $request)
    {
        $validated = $request->validated();
        $jobVacancy = JobVacancy::create($validated);
        return redirect()->route("job-vacancies.index")->with("success", "Job vacancy created successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $jobVacancy = JobVacancy::findOrFail($id);
        return view("job-vacancy.show", compact("jobVacancy"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $jobVacancy = JobVacancy::findOrFail($id);
        $companies = Company::all();
        $categories = JobCategory::all();
        return view("job-vacancy.editform", compact("jobVacancy", "companies", "categories"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JobVacancyUpdateRequest $request, string $id)
    {
        $validated = $request->validated();
        $jobVacancy = JobVacancy::findOrFail($id);
        $jobVacancy->update($validated);
        return redirect()->route("job-vacancies.show" , $id)->with("success","Job vacancy updated successfully!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        JobVacancy::findOrFail($id)->delete();
        return redirect()->route('job-vacancies.index')->with("success", "An Vacancy Archived");
    }

    public function restore(string $id)
    {
        $vacancy = JobVacancy::onlyTrashed()->find($id);
        $vacancy->restore();
        return redirect()->route("job-vacancies.index", ['archive' => 'true'])->with("success", "Vacancy Restore successfully!");
    }
}
