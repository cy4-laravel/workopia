<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Job;

class JobController extends Controller
{
    use AuthorizesRequests;
    
    /**
     * Display a listing of the resource.
     */
    // @desc show all jobs listings
    // @route GET /jobs
    public function index(): View
    {
        //
        $jobs = Job::paginate(6);
        // since jobs is the only thing we are gonna pass, so we can use with() syntax
        return view('jobs.index')->with('jobs', $jobs);
    }

    /**
     * Show the form for creating a new resource.
     */
    // @desc show create job form
    // @route GET /jobs/create
    public function create()
    {
        //
        return view('jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    // @desc save job to database
    // @route POST /jobs
    public function store(Request $request): RedirectResponse
    {
        // dd($request->file('company_logo'));
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'salary' => 'required|integer',
            'tags' => 'nullable|string',
            'job_type' => 'required|string',
            'remote' => 'required|boolean',
            'requirements' => 'nullable|string',
            'benefits' => 'nullable|string',
            'address' => 'nullable|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zipcode' => 'nullable|string',
            'contact_email' => 'required|string',
            'contact_phone' => 'nullable|string',
            'company_name' => 'required|string',
            'company_description' => 'nullable|string',
            'company_logo' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',
            'company_website' => 'nullable|url'

        ]);

        // hardcoded user id 
        $validatedData['user_id'] = auth()->user()->id;


        // check for image
        if($request->hasFile('company_logo')) {
            // store the file and get path
            $path = $request->file('company_logo')->store('logos', 'public');

            // Add path to validated data
            $validatedData['company_logo'] = $path;

        }

        // call the create method
        /**
         * just like we did in the tinker and we are bringing in 
         * app/models/job so we can use Job and use create method.
         * as shown below
         */
        // submit to database
        Job::create($validatedData); 

        // then we will use redirect

        return redirect()->route('jobs.index')->with('success', 'Job listing created successfully!');
    }

    /**
     * Display the specified resource.
     */
    // @desc Display a single job listings
    // @route GET /jobs/{$id}
    public function show(Job $job): View
    {
        //
        return view('jobs.show')->with('job', $job);
    }

    /**
     * Show the form for editing the specified resource.
     */
    // @desc show Edit job form
    // @route GET /jobs/{$id}/edit
    public function edit(Job $job): View
    {

        // check if user is authorized 
        $this->authorize('update', $job);

        return view('jobs.edit')->with('job', $job);
        //
    }

    /**
     * Update the specified resource in storage.
     */
    // @desc update job listings
    // @route PUT /jobs/{$id}
    public function update(Request $request, Job $job): string
    {

        // check if user is authorized 
        $this->authorize('update', $job);

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'salary' => 'required|integer',
            'tags' => 'nullable|string',
            'job_type' => 'required|string',
            'remote' => 'required|boolean',
            'requirements' => 'nullable|string',
            'benefits' => 'nullable|string',
            'address' => 'nullable|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zipcode' => 'nullable|string',
            'contact_email' => 'required|string',
            'contact_phone' => 'nullable|string',
            'company_name' => 'required|string',
            'company_description' => 'nullable|string',
            'company_logo' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',
            'company_website' => 'nullable|url'

        ]);

        // check for image, if new image then delete old one
        if($request->hasFile('company_logo')) {

            // Delete old logo
            Storage::delete('public/logos/' . basename($job->company_logo));

            // store the file and get path
            $path = $request->file('company_logo')->store('logos', 'public');

            // Add path to validated data
            $validatedData['company_logo'] = $path;

        }

        // call the create method
        /**
         * just like we did in the tinker and we are bringing in 
         * app/models/job so we can use Job and use create method.
         * as shown below
         */
        // submit to database
        $job->update($validatedData); 

        // then we will use redirect

        return redirect()->route('jobs.index')->with('success', 'Job listing updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    // @desc Delete a job listings
    // @route DELETE /jobs/{$id}
    public function destroy(Job $job): RedirectResponse
    {


        // check if user is authorized 
        $this->authorize('delete', $job);

        // if logo then delete it
        if($job->company_logo) {
            Storage::delete('public/logos/' . $job->company_logo);
        }
        
        $job->delete();

        // check if request came from dashboard
        if(request()->query('from') == 'dashboard'){
            return redirect()->route('dashboard')->with('success', 'Job listing deleted successfully!');    
        }
        return redirect()->route('jobs.index')->with('success', 'Job listing deleted successfully!');
    }
}
