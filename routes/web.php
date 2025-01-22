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

    // validate the attributes
    request()->validate([
        'title' => ['required', 'min:3'],  // title is required and should be more than three numbers
        'salary' => ['required']
    ]); // if this validation fails, user will be redirected to form again and laravel will pass an $error[] which contains all the attributes which failed

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
