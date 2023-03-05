@extends('layouts.app')

@section('title', 'Rounds')

@section('content')
    <a href="{{ route('seasons.show', $round->season) }}">Back to season</a>

    <div class="mt-4">
        <h1 class="font-black">{{ $round->name }}</h1>
        <p>{{ $round->circuit->name  }}</p>
    </div>

    @if ($round->results)
        <h4 class="font-bold mt-4">Race Results</h4>

        <table style="text-align: left;" class="w-full">
            <thead>
            <tr>
                <th>Pos</th>
                <th>Driver</th>
                <th>Grid</th>
                <th>Time</th>
                <th>Status</th>
                <th>Laps</th>
                <th>Fastest Lap</th>
                <th>Pts</th>
            </tr>
            </thead>
            <tbody>
            @foreach($round->results as $result)
                <tr>
                    <td>
                        <span class="mr-2">{{ $result->position }}</span>

{{--                        @if ($driver->pivot->hasChangedPosition())--}}
{{--                            {{ $driver->pivot->getPositionDiff() }}--}}

{{--                            @if ($driver->pivot->hasLostPositions())--}}
{{--                                <span class="text-red-600">▼</span>--}}
{{--                            @elseif ($driver->pivot->hasGainedPositions())--}}
{{--                                <span class="text-green-600">▲</span>--}}
{{--                            @endif--}}
{{--                        @endif--}}
                    </td>
                    <td>{{ $result->driver->full_name }}</td>
                    <td>{{ $result->grid }}</td>
                    <td>{{ $result->time }}</td>
                    <td>{{ $result->status->status }}</td>
                    <td>{{ $result->laps }}</td>
                    <td @class([
                        'text-purple-600' => $result->isFastestLap(),
                    ])>
                        {{ $result->fastestLapTime }}</td>
                    <td>{{ $result->points }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif

    @if ($round->qualifications)
        <h4 class="font-bold mt-8">Qualifying Results</h4>

        <table style="text-align: left" class="w-full">
            <thead>
            <tr>
                <th>Position</th>
                <th>Driver Name</th>
                <th>Q1 Time</th>
                <th>Q2 Time</th>
                <th>Q3 Time</th>
            </tr>
            </thead>
            <tbody>
            @foreach($round->qualifications as $qualification)
                <tr>
                    <td>{{ $qualification->position }}</td>
                    <td>{{ $qualification->driver->full_name }}</td>
                    <td>{{ $qualification->q1 }}</td>
                    <td>{{ $qualification->q2 ?? 'N/A' }}</td>
                    <td>{{ $qualification->q3 ?? 'N/A' }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
@endsection
