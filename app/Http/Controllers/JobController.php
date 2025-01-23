<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index(){
        $jobs = Job::with('employer')->latest()->simplePaginate(3);

        return view('jobs.index', [
            'jobs' => $jobs
        ]);
    }
    public function create(){
        return view('jobs.create');
    }
    public function show(Job $job){
        return view('jobs.show', ['job' => $job]);
    }
    public function store(){
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
    }
    public function edit(Job $job){
        return view('jobs.edit', ['job' => $job]);
    }
    public function update(Job $job){
        // authorization ( ....On hold)

        // validate the request
        request()->validate([
            'title' => ['required', 'min:3'],  // title is required and should be more than three numbers
            'salary' => ['required']
        ]);

        // update the job
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

    }
    public function destroy(Job$job){

        // authorize (... on hold)

        // delete the job
        $job->delete();

        // redirect
        return redirect('/jobs');
    }
}
