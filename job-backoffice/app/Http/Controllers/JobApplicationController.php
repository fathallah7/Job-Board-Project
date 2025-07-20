<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobApplicationUpdateRequest;
use App\Models\JobApplication;
use Illuminate\Http\Request;

class JobApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = JobApplication::latest();

        if (request()->archive) {
            $query->onlyTrashed();
        }

        $applications = $query->paginate(10)->onEachSide(1);

        return view("job-application.index", compact("applications"));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $jobApplication = JobApplication::findOrFail($id);
        return view("job-application.show", compact("jobApplication"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $jobApplication = JobApplication::findOrFail($id);
        return view("job-application.editform", compact("jobApplication"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JobApplicationUpdateRequest $request, string $id)
    {
        $jobApplication = JobApplication::findOrFail($id);
        $jobApplication->update([
                "status" => $request->input("status"),
            ]);
        return redirect()->route("job-applications.show", $jobApplication->id)->with("success", "An Application Updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        JobApplication::findOrFail($id)->delete();
        return redirect()->route('job-applications.index')->with("success", "An Application Archived");
    }

    public function restore(string $id)
    {
        $vacancy = JobApplication::onlyTrashed()->find($id);
        $vacancy->restore();
        return redirect()->route("job-applications.index", ['archive' => 'true'])->with("success", "Application Restored successfully!");
    }
}
