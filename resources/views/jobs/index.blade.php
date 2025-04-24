@extends('layout')

@section('content')
    <h1>Available jobs</h1>
    <ul>
        @forelse($jobs as $job)
            
            <li>{{$job}}</li>
        @empty
            <p>No Jobs avaiable</p>
        @endforelse
    </ul>
@endsection

