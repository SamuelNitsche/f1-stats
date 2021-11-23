@extends('layouts.app')

@section('title', $driver->full_name)

@section('content')
    <h3>{{ $driver->full_name }}</h3>

    <h4>Seasons</h4>
    @foreach($driver->seasons as $season)
        <p>{{ $season->year }}</p>
    @endforeach

    <h4>Race results</h4>
    <table style="text-align: left;">
        <thead>
        <tr>
            <th>Season</th>
            <th>Track</th>
            <th>Position</th>
            <th>Points</th>
            <th>Fastest lap</th>
        </tr>
        </thead>
        <tbody>
        @foreach($driver->races()->with('season', 'track')->latest()->get() as $race)
            <tr>
                <td>
                    {{ $race->season->year }}
                </td>
                <td>
                    {{ $race->track->name }}
                </td>
                <td>
                    {{ $race->pivot->position }}
                </td>
                <td>
                    {{ $race->pivot->points }}
                </td>
                <td>
                    {{ $race->pivot->fastest_lap_time }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <h4>Qualifying results</h4>
    <table style="text-align: left;">
        <thead>
        <tr>
            <th>Season</th>
            <th>Track</th>
            <th>Position</th>
            <th>Q1</th>
            <th>Q2</th>
            <th>Q3</th>
        </tr>
        </thead>
        <tbody>
        @foreach($driver->qualifications()->with('season', 'track')->latest()->get() as $qualification)
            <tr>
                <td>
                    {{ $qualification->season->year }}
                </td>
                <td>
                    {{ $qualification->track->name }}
                </td>
                <td>
                    {{ $qualification->pivot->position }}
                </td>
                <td>
                    {{ $qualification->pivot->q1_time ?? 'N/A' }}
                </td>
                <td>
                    {{ $qualification->pivot->q2_time ?? 'N/A' }}
                </td>
                <td>
                    {{ $qualification->pivot->q3_time ?? 'N/A' }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
