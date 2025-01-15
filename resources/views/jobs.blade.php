<x-layout>
    <x-slot:heading>Jobs Listings</x-slot:heading>

    <ul>
    @foreach( $jobs as $job)
            <a href="/jobs/{{ $job['id'] }}" class=" hover:underline">
                <li><strong class="text-blue-500"> {{ $job['title'] }} : </strong> Pays {{ $job['salary'] }}</li>
            </a>
    @endforeach
    </ul>

</x-layout>
