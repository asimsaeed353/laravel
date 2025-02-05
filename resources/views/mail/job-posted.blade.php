<h2>
    {{ $job->title }}
</h2>

<p>
    Congrats! Your Job is live.
</p>

<p>
    <a href=" {{ url('/jobs/' . $job->id) }}">View Your Job Listing</a>
</p>
