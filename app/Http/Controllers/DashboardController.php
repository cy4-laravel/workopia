<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // @desc show all user job listings
    // @route get/ dashboard
    public function index(): View {
        // get logged in user
        $user = Auth::user();
        // get the user listings
        $jobs = Job::where('user_id', $user->id)->get();
        // dd($jobs);
        return view('dashboard.index', compact('user', 'jobs'));
    }
}
