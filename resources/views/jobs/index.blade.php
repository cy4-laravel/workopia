<x-layout>
    <h1>Available jobs</h1>
    <ul>
        @forelse($jobs as $job)
            <li><a href="{{route('jobs.show', $job->id)}}">{{$job['title']}} - {{$job->description}}</a></li>
        @empty
            <p>No Jobs avaiable</p>
        @endforelse
    </ul>
</x-layout>
