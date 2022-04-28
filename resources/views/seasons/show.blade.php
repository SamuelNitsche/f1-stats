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
        @foreach ($season->getStandings() as $standing)
            <tr>
                <td>{{ $standing->driver->full_name }}</td>
                <td>{{ $standing->points }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <br>

    @foreach ($season->races()->with('circuit')->get() as $race)
        <p>
            <a href="{{ route('rounds.show', [$season, $race]) }}">#{{$race->round}} &mdash;
                {{ $race->name }} &mdash; {{ $race->circuit->name }}</a>
        </p>
    @endforeach
@endsection
