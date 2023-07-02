@extends('layouts.app')

@section('title', "Season $season->year Overview")

@section('content')
    <div class="flex space-x-4 overflow-scroll my-4">
        @foreach(\App\Models\Season::latest('year')->get() as $tmpSeason)
            <span><a href="{{ route('seasons.show', $tmpSeason) }}"
                @class([
                    'font-bold' => $season->is($tmpSeason)
                ])
            >{{ $tmpSeason->year }}</a></span>
        @endforeach
    </div>

    <p class="font-black">{{ $season->year }} Season</p>

    @if($season->isOver())
        <div class="my-4">
            <p>{{ $season->getDriverChampionshipWinner()->full_name }} won the Championship</p>
            <p>{{ $season->getConstructorChampionshipWinner()->name }} won the Constructor Championship</p>
        </div>
    @endif

    <div class="grid grid-cols-2">
        <div class="">
            @foreach($standings['podium'] as $standing)
{{--                @dd($standing)--}}
                <div>
                    <span>{{ 1 + $loop->index }}</span>
                    <span>{{ $standing->driver->full_name }}</span>
                    <span>{{ $standing->points }}</span>
                </div>
            @endforeach
        </div>

        <div>
            @foreach($standings['rest'] as $standing)
                <div>
                    <span>{{ 4 + $loop->index }}</span>
                    <span>{{ $standing->driver->full_name }}</span>
                    <span>{{ $standing->points }}</span>
                </div>
            @endforeach
        </div>
    </div>

{{--    <h2 class="text-lg">Standings</h2>--}}
{{--    <table class="text-left w-full">--}}
{{--        <thead>--}}
{{--        <tr>--}}
{{--            <th>Name</th>--}}
{{--            <th>Points</th>--}}
{{--        </tr>--}}
{{--        </thead>--}}
{{--        <tbody>--}}
{{--        @foreach ($season->getStandings() as $standing)--}}
{{--            <tr>--}}
{{--                <td>{{ $standing->driver->full_name }}</td>--}}
{{--                <td>{{ $standing->points }}</td>--}}
{{--            </tr>--}}
{{--        @endforeach--}}
{{--        </tbody>--}}
{{--    </table>--}}

    <br>

    @foreach ($season->races()->with('circuit')->get() as $race)
        <p>
            <a href="{{ route('rounds.show', [$season, $race]) }}">#{{$race->round}} &mdash;
                {{ $race->name }} &mdash; {{ $race->circuit->name }}</a>
        </p>
    @endforeach
@endsection
