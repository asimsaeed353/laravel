<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model {
    protected $table = 'job_listings';  // database table name
    protected $fillable = ['title', 'salary'];  // explicitly allowing attributes to be mass assigned
}
