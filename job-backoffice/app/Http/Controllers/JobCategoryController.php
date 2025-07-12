<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobCategoryRequest;
use App\Http\Requests\JobCategoryUpdateRequest;
use App\Models\JobCategory;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;

class JobCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = JobCategory::latest();

        if ($request->archive) {
            $query->onlyTrashed();
        }

        $categories = $query->paginate(10)->onEachSide(1);
        return view('job-category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('job-category.addform');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobCategoryRequest $request)
    {
        $validated = $request->validated();
        JobCategory::create($validated);
        return redirect()->route('job-categories.index')->with('success', "Job Category ( $request->name ) created Successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = JobCategory::findOrFail($id);
        return view('job-category.editform', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JobCategoryUpdateRequest $request, string $id)
    {
        $validated = $request->validated();
        JobCategory::findOrFail($id)->update($validated);
        return redirect()->route('job-categories.index')->with('success', "An Category Updated");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        JobCategory::findOrFail($id)->delete();
        return redirect()->route("job-categories.index")->with("success","Category Archived");
    }
}
