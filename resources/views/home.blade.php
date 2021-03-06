@extends('layouts.app')

@section('title', 'Home')

@section('content')
{{--    <h4>Last Race</h4>--}}
{{--    <p>--}}
{{--        <a--}}
{{--            href="{{ route('rounds.show', [$previousRound->season, $previousRound]) }}"--}}
{{--        >{{ $previousRound->name }}</a>--}}
{{--    </p>--}}

{{--    @if ($upcomingRound)--}}
{{--        <h4>Next Race</h4>--}}
{{--        <p>--}}
{{--            <a--}}
{{--                href="{{ route('rounds.show', [$upcomingRound->season, $upcomingRound]) }}"--}}
{{--            >{{ $upcomingRound->name }} - in--}}
{{--                <time--}}
{{--                    datetime="{{ $upcomingRound->date }}">{{ $upcomingRound->date->longAbsoluteDiffForHumans() }}</time>--}}
{{--            </a>--}}
{{--        </p>--}}
{{--    @endif--}}

    <h1>Season {{ $currentSeason->year }} ({{ $currentSeason->hasEnded() }})</h1>

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
        @foreach ($currentSeason->getStandings() as $standing)
            <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $standing->driver->full_name }}</td>
                <td>{{ $standing->points }}</td>
            </tr>
        @endforeach
    </table>

@endsection
