<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Job;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        //
        $jobs = Job::all();
        // since jobs is the only thing we are gonna pass, so we can use with() syntax
        return view('jobs.index')->with('jobs', $jobs);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        //
        return view('jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): string
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string'
        ]);

        // next we will call the create method
        /**
         * just like we did in the tinker and we are bringing in 
         * app/models/job so we can use Job and use create method.
         * as shown below
         */
        Job::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description']
        ]); 

        // then we will use redirect

        return redirect()->route('jobs.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job): View
    {
        //
        return view('jobs.show')->with('job', $job);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): string
    {
        return "Edit";
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): string
    {
        return "Update";
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): string
    {
        return "Destroy";
        //
    }
}
