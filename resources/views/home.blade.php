@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="flex overflow-x-scroll snap-x snap-proximity snap-mandatory">
        @foreach ($currentSeason->races as $round)
            @php
                $isNext = $round->is($upcomingRound)
            @endphp

            <div @class([
                    'block',
                    'px-4',
                    'py-8',
                    'text-center',
                    'uppercase',
                    'italic',
                    'snap-center',
                    'w-2/3' => $isNext,
                    'min-w-max' => !$isNext
                ])>
                <p @class([
                    'pb-4',
                    'font-black' => $isNext,
                    'active' => $isNext
                    ])
                >
                    {{ str_replace('Grand Prix', '', $round->name) }}
                </p>

                @if ($isNext)
                    <div class="flex items-center justify-between text-xs not-italic normal-case w-96">
                        <div>
                            @if ($round->qualify_date)
                                <p>Qualifying {{ $round->qualify_date->format('d M Y') }} {{ $round->qualify_time }}</p>
                            @else
                                <p>Sprint {{ $round->sprint_date->format('d M Y') }} {{ $round->sprint_time }}</p>
                            @endif
                        </div>

                        <div>
                            <p>Race {{ $round->date->format('d M Y') }} {{ $round->time }}</p>

                        </div>
                    </div>
                @else
                    <p class="block text-sm font-semibold italic">{{ $round->getDate()->format('d M Y') }}</p>
                @endif
            </div>
        @endforeach
    </div>

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

    @if($previousRound)
        <h4>Last Race</h4>
        <p>
            <a href="{{ route('rounds.show', [$previousRound->season, $previousRound]) }}">{{ $previousRound->name }}</a>
        </p>
    @endif

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

@push('scripts')
    <script>
        document.querySelectorAll('.active').forEach(item => item.scrollIntoView({
            behavior: "smooth",
            block: "end",
            inline: "center"
        }))
    </script>
@endpush
