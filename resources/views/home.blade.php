@extends('layouts.app')

@section('title', 'Home')

@section('styles')
    <style>
        .swiper-slide {
            width: auto !important;
        }
    </style>
@endsection

@section('content')
    <div class="swiper">
        <div class="swiper-wrapper flex">
            @foreach ($currentSeason->races as $round)
                @php
                    $isNext = $round->is($upcomingRound)
                @endphp

                <div @class([
                    'swiper-slide',
                    'block',
                    'px-4',
                    'py-8',
                    'text-center',
                    'border-b',
                    'h-full',
                    'w-2/3' => $isNext,
                    'min-w-max' => !$isNext,
                    'border-r' => !$loop->last,
                    'opacity-50' => $round->hasFinished(),
                ])>
                    <div @class([
                    'pb-4',
                    'font-black' => $isNext,
                    'active' => $isNext,
                    ])
                    >
                        <p class="font-black uppercase">{{ $round->name }}</p>
                        <p class="text-xs font-semibold text-gray-800">{{ $round->circuit->name }}</p>
                    </div>

                    <div class="flex items-center justify-between text-xs normal-case w-96">
                        <div>
                            @if ($round->qualifying_starts_at)
                                <p>
                                    <span class="text-gray-700">Qualifying:</span>
                                    <span
                                        class="font-bold" data-date="{{ $round->qualifying_starts_at }}">{{ $round->qualifying_starts_at->format('d M Y H:i') }}</span>
                                </p>
                            @else
                                <p>
                                    <span class="text-gray-700">Sprint:</span>
                                    <span class="font-bold" data-date="{{ $round->sprint_starts_at }}">{{ $round->sprint_starts_at->format('d M Y H:i') }}</span>
                                </p>
                            @endif
                        </div>

                        <div>
                            <p>
                                <span class="text-gray-700">Race:</span>
                                <span class="font-bold" data-date="{{ $round->starts_at }}">{{ $round->starts_at->format('d M Y H:i') }}</span>
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>


        {{--    @if ($upcomingRound)--}}
        {{--        <h4 class="text-center font-bold text-xl pt-8">Next Session</h4>--}}
        {{--        <p class="text-center text-sm font-bold py-4">in</p>--}}
        {{--        <x-countdown :expires="$upcomingRound->getNextSessionDate()">--}}
        {{--            <span class="hidden">{{ $component->days() }} days, {{ $component->hours() }} hours</span>--}}

        {{--            <div class="flex items-center justify-evenly">--}}
        {{--                <div class="text-center">--}}
        {{--                    <p class="text-xl font-black" x-text="timer.days">{{ $component->days() }}</p>--}}
        {{--                    <small class="text-sm font-semibold">Days</small>--}}
        {{--                </div>--}}
        {{--                <div class="text-center">--}}
        {{--                    <p class="text-xl font-black" x-text="timer.hours">{{ $component->hours() }}</p>--}}
        {{--                    <small class="text-sm font-semibold">Hours</small>--}}
        {{--                </div>--}}
        {{--                <div class="text-center">--}}
        {{--                    <p class="text-xl font-black" x-text="timer.minutes">{{ $component->minutes() }}</p>--}}
        {{--                    <small class="text-sm font-semibold">Minutes</small>--}}
        {{--                </div>--}}
        {{--                <div class="text-center">--}}
        {{--                    <p class="text-xl font-black" x-text="timer.seconds">{{ $component->seconds() }}</p>--}}
        {{--                    <small class="text-sm font-semibold">Seconds</small>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </x-countdown>--}}
        {{--    @endif--}}

        {{--    @if($previousRound)--}}
        {{--        <h4>Last Race</h4>--}}
        {{--        <p>--}}
        {{--            <a href="{{ route('rounds.show', [$previousRound->season, $previousRound]) }}">{{ $previousRound->name }}</a>--}}
        {{--        </p>--}}
        {{--    @endif--}}

        {{--    @if($currentSeason->getStandings())--}}
        {{--        <h1 class="font-bold text-lg mt-8">Season {{ $currentSeason->year }}</h1>--}}

        {{--        <h4 class="font-semibold text-md mt-4">Current standings</h4>--}}
        {{--        <table class="text-left w-full">--}}
        {{--            <thead>--}}
        {{--            <tr>--}}
        {{--                <th>#</th>--}}
        {{--                <th>Name</th>--}}
        {{--                <th>Points</th>--}}
        {{--            </tr>--}}
        {{--            </thead>--}}
        {{--            <tbody></tbody>--}}
        {{--            @foreach ($currentSeason->getStandings() as $standing)--}}
        {{--                <tr>--}}
        {{--                    <td>{{ $loop->index + 1 }}</td>--}}
        {{--                    <td>{{ $standing->driver->full_name }}</td>--}}
        {{--                    <td>{{ $standing->points }}</td>--}}
        {{--                </tr>--}}
        {{--            @endforeach--}}
        {{--        </table>--}}
        {{--    @endif--}}

        @endsection

        @push('scripts')
            <script>
                document.querySelectorAll('.active').forEach(item => item.scrollIntoView({
                    behavior: "smooth",
                    block: "end",
                    inline: "center"
                }))

                const swiper = new Swiper('.swiper', {
                    direction: 'horizontal',
                    freeMode: false,
                    slidesPerView: 'auto',
                })
            </script>
    @endpush

