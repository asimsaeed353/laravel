<?php

use Illuminate\Support\Facades\Route;
use App\Models\Job;

Route::get('/', function () {
    return view('home');
});


Route::get('/jobs', function () {
    $jobs = Job::with('employer')->simplePaginate(3);

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

Route::get('/contact', function () {
    return view('contact');
});
