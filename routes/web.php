<?php

use Illuminate\Support\Facades\Route;
use App\Models\Job;

Route::get('/', function () {
    return view('home');
});

// Index Jobs
Route::get('/jobs', function () {
    $jobs = Job::with('employer')->latest()->simplePaginate(3);

    return view('jobs.index', [
        'jobs' => $jobs
    ]);
});

// Create Job
Route::get('jobs/create', function(){
    return view('jobs.create');
});

// Display a single job
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

// Edit a job
Route::get('/jobs/{id}/edit', function ($id) {
    $job = Job::find($id);

    return view('jobs.edit', ['job' => $job]);

});

// Edit Job
Route::patch('/jobs/{id}', function ($id) {

    // validate the request
    request()->validate([
        'title' => ['required', 'min:3'],  // title is required and should be more than three numbers
        'salary' => ['required']
    ]);

    // authorization ( ....On hold)

    // update the job

    $job = Job::findOrFail($id);  // findOrFail() : won't proceed if the job is null

    $job->update([
        'title' => request('title'),
        'salary' => request('salary'),
    ]);

    // OR

    /*
    $job->title = request('title');
    $job->salary = request('title');
    $job->save();
     */

    // redirect to the specific page
    return redirect('/jobs/' . $job->id);

});

// Delete Job
Route::delete('/jobs/{id}', function ($id) {

    // authorize (... on hold)

    // delete the job
    Job::findOrFail($id)->delete();

    // redirect
    return redirect('/jobs');
});

Route::get('/contact', function () {
    return view('contact');
});
