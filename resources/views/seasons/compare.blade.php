@extends('layouts.app')

@section('title', "Compare drivers")

@section('content')
    <p class="font-bold text-xl mt-4">Compare {{ collect($drivers->map->fullName)->join(', ', ' and ') }} in the {{ $season->year }} season</p>

    @foreach($data as $track => $foo)
        <div class="py-8">
            <p class="font-semibold text-md">{{ $track }}</p>
            <table class="w-full text-left">
                <thead>
                <tr>
                    <th></th>
                    @foreach ($foo as $ref => $driver)
                        <th>{{ $drivers->where('driverRef', $ref)->first()->fullName }}</th>
                    @endforeach
                </tr>
                </thead>
                <tbody class="border">
                <tr>
                    <th>Q1</th>
                    @foreach ($foo as $ref => $driver)
                        <td>{{ data_get($driver, 'qualification.q1', 'N/A') }}</td>
                    @endforeach
                </tr>
                <tr>
                    <th>Q2</th>
                    @foreach ($foo as $ref => $driver)
                        <td>{{ data_get($driver, 'qualification.q2', 'N/A') }}</td>
                    @endforeach
                </tr>
                <tr>
                    <th>Q3</th>
                    @foreach ($foo as $ref => $driver)
                        <td>{{ data_get($driver, 'qualification.q3', 'N/A') }}</td>
                    @endforeach
                </tr>
                <tr>
                    <th>Grid</th>
                    @foreach ($foo as $ref => $driver)
                        <td>{{ data_get($driver, 'race.grid', 'N/A') }}</td>
                    @endforeach
                </tr>
                <tr>
                    <th>Position</th>
                    @foreach ($foo as $ref => $driver)
                        <td>{{ data_get($driver, 'race.positionOrder', 'N/A') }}</td>
                    @endforeach
                </tr>
                <tr>
                    <th>Fastest Lap</th>
                    @foreach ($foo as $ref => $driver)
                        <td>{{ data_get($driver, 'race.fastestLap', 'N/A') }}</td>
                    @endforeach
                </tr>
                <tr>
                    <th>Fastest Lap Time</th>
                    @foreach ($foo as $ref => $driver)
                        <td>{{ data_get($driver, 'race.fastestLapTime', 'N/A') }}</td>
                    @endforeach
                </tr>
                <tr>
                    <th>Status</th>
                    @foreach ($foo as $ref => $driver)
                        <td>{{ data_get($driver, 'race.status.status', 'N/A') }}</td>
                    @endforeach
                </tr>
                <tr>
                    <th>Points gained</th>
                    @foreach ($foo as $ref => $driver)
                        <td>{{ data_get($driver, 'race.points', 'N/A') }}</td>
                    @endforeach
                </tr>
                <tr>
                    <th>Rank after the race</th>
                    @foreach ($foo as $ref => $driver)
                        <td>{{ data_get($driver, 'race.rank', 'N/A') }}</td>
                    @endforeach
                </tr>
                </tbody>
            </table>
        </div>
    @endforeach
@endsection
