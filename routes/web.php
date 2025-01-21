<?php

use Illuminate\Support\Facades\Route;
use App\Models\Job;

Route::get('/', function () {
    return view('home');
});

/* Lazy Loading

Route::get('/jobs', function () {
    return view('jobs', [
        'jobs' => Job::all()
    ]);
});

*/

Route::get('/jobs', function () {
//    $jobs = Job::with('employer')->paginate(3);   // Pagination in action

    $jobs = Job::with('employer')->simplePaginate(3);
//    $jobs = Job::with('employer')->cursorPaginate(3);

    // lazy loading is disabled by default. You can only eager load now.

    return view('jobs', [
        'jobs' => $jobs
    ]);
});

Route::get('/jobs/{id}', function ($id) {
    // grab the job which has id equals to the user requested id
    $job = Job::find($id);

    // load the view
    return view('job', ['job' => $job]);

});

Route::get('/contact', function () {
    return view('contact');
});
