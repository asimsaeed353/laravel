<?php

use Illuminate\Support\Facades\Route;
use App\Models\Job;

Route::get('/', function () {
    return view('home');
});


Route::get('/jobs', function () {
    $jobs = Job::with('employer')->latest()->simplePaginate(3);

    return view('jobs.index', [
        'jobs' => $jobs
    ]);
});

Route::get('jobs/create', function(){
    return view('jobs.create');
});

Route::get('/jobs/{id}', function ($id) {
    // grab the job which has id equals to the user requested id
    $job = Job::find($id);

    // load the view
    return view('jobs.show', ['job' => $job]);

});

// Post request from Create Job form
Route::post('/jobs', function () {

    Job::create([
        'title' => request('title'),
        'salary' => request('salary'),
        'employer_id' => 1
    ]);

    return redirect('/jobs');
});

Route::get('/contact', function () {
    return view('contact');
});
