@extends('layouts.app')

@section('title', 'Home')

@section('content')
    @if ($upcomingRound)
        <h4 class="text-center font-bold text-xl py-8">Next Session</h4>
        <x-countdown :expires="$upcomingRound->getNextSessionDate()">
            <span class="hidden">{{ $component->days() }} days, {{ $component->hours() }} hours</span>

            <div class="flex items-center justify-evenly">
                <div class="text-center">
                    <p class="text-xl font-black" x-text="timer.days">{{ $component->days() }}</p>
                    <small class="text-sm font-semibold">Days</small>
                </div>
                <div class="text-center">
                    <p class="text-xl font-black" x-text="timer.hours">{{ $component->hours() }}</p>
                    <small class="text-sm font-semibold">Hours</small>
                </div>
                <div class="text-center">
                    <p class="text-xl font-black" x-text="timer.minutes">{{ $component->minutes() }}</p>
                    <small class="text-sm font-semibold">Minutes</small>
                </div>
                <div class="text-center">
                    <p class="text-xl font-black" x-text="timer.seconds">{{ $component->seconds() }}</p>
                    <small class="text-sm font-semibold">Seconds</small>
                </div>
            </div>
        </x-countdown>
    @endif

    <h4>Last Race</h4>
    <p>
        <a href="{{ route('rounds.show', [$previousRound->season, $previousRound]) }}">{{ $previousRound->name }}</a>
    </p>

    <h1 class="font-bold text-lg">Season {{ $currentSeason->year }}</h1>

    <h4 class="font-semibold text-md">Current standings</h4>
    <table class="text-left w-full">
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
