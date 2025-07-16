<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyCreateRequest;
use App\Http\Requests\CompanyUpdateRequest;
use App\Models\Company;
use App\Models\User;
use finfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CompanyController extends Controller
{

    public $industries = ['Technology', 'Finance', 'Healthcare', 'Education', 'Manufacturing', 'Retail', 'Other'];

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Company::latest();

        if ($request->archive) {
            $query->onlyTrashed();
        }

        $companies = $query->paginate(10)->onEachSide(1);
        return view('job-company.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $industries = $this->industries;
        return view('job-company.addform', compact('industries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompanyCreateRequest $request)
    {
        $validated = $request->validated();

        $owner = User::create([
            'name' => $validated['owner_name'],
            'email' => $validated['owner_email'],
            'password' => Hash::make($validated['owner_password']),
            'role' => 'company_owner',
        ]);

        if (!$owner) {
            return redirect()->route('companies.create')->with('error', 'Error In Store Owner Informations');
        }

        $company = Company::create([
            'name' => $validated['name'],
            'address' => $validated['address'],
            'industry' => $validated['industry'],
            'website' => $validated['website'],
            'owner_id' => $owner->id,
        ]);

        if (!$company) {
            return redirect()->route('companies.create')->with('error', 'Error In Store Company Informations');
        }

        return redirect()->route('companies.index')->with('success', "Company ( $request->name ) Created Successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $company = Company::find($id);
        return view("job-company.show", compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $company = Company::findOrFail($id);
        $industries = $this->industries;
        return view('job-company.editform', compact('company', 'industries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CompanyUpdateRequest $request, string $id)
    {
        $validated = $request->validated();
        Company::findOrFail($id)->update([
            'name' => $validated['name'],
            'address' => $validated['address'],
            'industry' => $validated['industry'],
            'website' => $validated['website'],
        ]);

        // Update owner
        $ownerData = [];
        $ownerData['name'] = $validated['owner_name'];

        if ($validated['owner_password']) {
            $ownerData['password'] = Hash::make($validated['owner_password']);
        }

        $company = Company::findOrFail($id);
        $company->owner()->update($ownerData);
        

        return redirect()->route('companies.show' , $id)->with('success', "An company Updated");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Company::findOrFail($id)->delete();
        return redirect()->route("companies.index")->with("success", "company Archived");
    }

    public function restore(string $id)
    {
        $company = Company::onlyTrashed()->find($id);
        $company->restore($id);
        return redirect()->route("companies.index", ['archive' => 'true'])->with("success", "Company restored successfully!");
    }
}
