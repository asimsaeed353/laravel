<?php

use App\Http\Controllers\JobController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use App\Jobs\TranslateJob;
use App\Mail\JobPosted;
use App\Models\Job;
use Illuminate\Support\Facades\Route;

Route::get('test', function (){

    $job = Job::first(); // grab the first job

    TranslateJob::dispatch($job);  // pass the job instance so we can translate the job details in the TranslateJob

    return 'Done';
});

Route::view('/', 'home');
Route::view('/contact', 'contact');

/* Revert to Single Routes */

Route::get('/jobs', [JobController::class, 'index']);
Route::get('/jobs/create', [JobController::class, 'create']);
Route::post('/jobs', [JobController::class, 'store'])->middleware('auth');

Route::get('/jobs/{job}', [JobController::class, 'show']);
Route::get('/jobs/{job}/edit', [JobController::class, 'edit'])
    ->middleware('auth')
    ->can('edit', 'job');

Route::patch('//jobs/{job}', [JobController::class, 'update'])->middleware('auth')->can('update-job', 'job');
Route::delete('/jobs/{job}', [JobController::class, 'destroy'])->middleware('auth')->can('delete-job', 'job');



// Auth
Route::get('/register', [RegisteredUserController::class, 'create']);
// create
Route::Post('/register', [RegisteredUserController::class, 'store']);


Route::get('/login', [SessionController::class, 'create'])->name('login');
Route::post('/login', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy']);


