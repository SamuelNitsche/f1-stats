@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <h4>Last Race</h4>
    <p>
        <a
            href="{{ route('rounds.show', [$previousRound->season, $previousRound]) }}"
        >{{ $previousRound->name }}</a>
    </p>

    <h4>Next Race</h4>
    <p>
        <a
            href="{{ route('rounds.show', [$upcomingRound->season, $upcomingRound]) }}"
        >{{ $upcomingRound->name }} - in
            <time datetime="{{ $upcomingRound->date }}">{{ $upcomingRound->date->longAbsoluteDiffForHumans() }}</time>
        </a>
    </p>

    <h4>Current standings</h4>
    <table class="text-left">
        <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Points</th>
        </tr>
        </thead>
        <tbody></tbody>
        @foreach ($currentSeason->getStandings() as $driver)
            <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $driver->full_name }}</td>
                <td>{{ $driver->points($currentSeason) }}</td>
            </tr>
        @endforeach
    </table>

@endsection
