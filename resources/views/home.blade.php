@extends('layouts.app')

@section('title', 'Home')

@section('content')
    @if ($upcomingRound)
        <h4 class="text-center font-bold text-xl py-8">Next Race</h4>
        <div class="flex items-center justify-evenly" x-data="timer('{{ $upcomingRound->getDate() }}')" x-init="init();">
            <div class="text-center">
                <p class="text-xl font-black" x-text="time().days"></p>
                <small class="text-sm font-semibold">Days</small>
            </div>
            <div class="text-center">
                <p class="text-xl font-black" x-text="time().hours"></p>
                <small class="text-sm font-semibold">Hours</small>
            </div>
            <div class="text-center">
                <p class="text-xl font-black" x-text="time().minutes"></p>
                <small class="text-sm font-semibold">Minutes</small>
            </div>
            <div class="text-center">
                <p class="text-xl font-black" x-text="time().seconds"></p>
                <small class="text-sm font-semibold">Seconds</small>
            </div>
        </div>

{{--        <p>--}}
{{--        <a--}}
{{--                href="{{ route('rounds.show', [$upcomingRound->season, $upcomingRound]) }}"--}}
{{--            >{{ $upcomingRound->name }} - in--}}
{{--                <time--}}
{{--                    datetime="{{ $upcomingRound->date }}">{{ $upcomingRound->date->longAbsoluteDiffForHumans() }}</time>--}}
{{--            </a>--}}
{{--        </p>--}}
    @endif

    <h4>Last Race</h4>
    <p>
        <a
            href="{{ route('rounds.show', [$previousRound->season, $previousRound]) }}"
        >{{ $previousRound->name }}</a>
    </p>

    <h1>Season {{ $currentSeason->year }}</h1>

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

@push('scripts')
    <script>
        function timer(expiry) {
            return {
                expiry: new Date(expiry),
                remaining: null,
                init() {
                    this.setRemaining()
                    setInterval(() => {
                        this.setRemaining();
                    }, 1000);
                    console.log(this.expiry)
                },
                setRemaining() {
                    const diff = this.expiry - new Date().getTime();
                    this.remaining =  parseInt(diff / 1000);
                },
                days() {
                    return {
                        value:this.remaining / 86400,
                        remaining:this.remaining % 86400
                    };
                },
                hours() {
                    return {
                        value:this.days().remaining / 3600,
                        remaining:this.days().remaining % 3600
                    };
                },
                minutes() {
                    return {
                        value:this.hours().remaining / 60,
                        remaining:this.hours().remaining % 60
                    };
                },
                seconds() {
                    return {
                        value:this.minutes().remaining,
                    };
                },
                format(value) {
                    return ("0" + parseInt(value)).slice(-2)
                },
                time(){
                    return {
                        days:this.format(this.days().value),
                        hours:this.format(this.hours().value),
                        minutes:this.format(this.minutes().value),
                        seconds:this.format(this.seconds().value),
                    }
                },
            }
        }
    </script>
@endpush
