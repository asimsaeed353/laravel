<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Job extends Model {

    use HasFactory;  // to generate factories of jobs

    protected $table = 'job_listings';  // database table name
    protected $fillable = ['title', 'salary'];  // explicitly allowing attributes to be mass assigned

    public function employer() {
        return $this->belongsTo(Employer::class);
    }
    public function tags() {
        return $this->belongsToMany(Tag::class, foreignPivotKey: "job_listing_id");
    } // $job->tags;
}
