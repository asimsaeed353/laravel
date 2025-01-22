<x-layout>
    <x-slot:heading>Job: {{ $job->title }}</x-slot:heading>

    <h1 class="font-bold text-lg">{{ $job->title }}</h1>
    <p>
        This job pays {{ $job->salary }} per year.
    </p>

    <p class="mt-5">
        <x-button href="/jobs/{{ $job->id }}/edit"> Edit Job </x-button>
    </p>

</x-layout>
