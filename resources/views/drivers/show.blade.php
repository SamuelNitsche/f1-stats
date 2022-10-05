@extends('layouts.app')

@section('title', $driver->full_name)

@section('content')
    <h3>{{ $driver->full_name }}</h3>

    <h4>Seasons</h4>
    @foreach($driver->seasons as $season)
        <p>{{ $season->year }}</p>
    @endforeach

    <h4>Race results</h4>
        @foreach($driver->results()->with('season', 'race.circuit')->latest('raceId')->get()->groupBy('season.year') as $season => $results)
            {{ $season }}

            <table style="text-align: left;" class="w-full">
                <thead>
                <tr>
                    <th>Season</th>
                    <th>Race</th>
                    <th>Position</th>
                    <th>Points</th>
                    <th>Fastest lap</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($results as $result)
                        <tr>
                            <td>
                                {{ $result->season->year }}
                            </td>
                            <td>
                                {{ $result->race->name }}
                            </td>
                            <td>
                                {{ $result->position }}
                            </td>
                            <td>
                                {{ $result->points }}
                            </td>
                            <td>
                                {{ $result->fastestLapTime }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endforeach

    <h4>Qualifying results</h4>
    <table style="text-align: left;" class="w-full">
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
        @foreach($driver->qualifications()->with('season', 'circuit')->latest('raceId')->get() as $qualification)
            <tr>
                <td>
                    {{ $qualification->season->year }}
                </td>
                <td>
                    {{ $qualification->circuit->name }}
                </td>
                <td>
                    {{ $qualification->po }}
                </td>
                <td>
                    {{ $qualification->q1 ?? 'N/A' }}
                </td>
                <td>
                    {{ $qualification->q2 ?? 'N/A' }}
                </td>
                <td>
                    {{ $qualification->q3 ?? 'N/A' }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
