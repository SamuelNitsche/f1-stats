@extends('layouts.app')

@section('title', $season->year)

@section('content')
    <p><a href="{{ route('seasons.index') }}">Back to all seasons</a></p>

    <br>

    <p>{{ $season->year }}</p>

    <br>

    <h2 class="text-lg">Standings</h2>
    <table class="text-left">
        <thead>
        <tr>
            <th>Name</th>
            <th>Points</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($season->getStandings() as $driver)
            <tr>
                <td>{{ $driver->full_name }}</td>
                <td>{{ $driver->points($season) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <br>

    @foreach ($season->rounds()->with('track')->get() as $round)
        <p>
            <a href="{{ route('rounds.show', [$season, $round->round]) }}">#{{$round->round}} &mdash;
                {{ $round->name }} &mdash; {{ $round->track->name }}</a>
        </p>
    @endforeach
@endsection
