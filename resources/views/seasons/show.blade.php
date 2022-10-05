@extends('layouts.app')

@section('title', "Season $season->year Overview")

@section('content')
    <div x-data="seasonSelect()" x-init="watch()" >
        <select x-model="season">
            @foreach(\App\Models\Season::latest('year')->get() as $tmpSeason)
                <option value="{{ $tmpSeason->year }}">{{ $tmpSeason->year }}</option>
            @endforeach
        </select>
    </div>

    <p>{{ $season->year }}</p>

    <br>

    <h2 class="text-lg">Standings</h2>
    <table class="text-left w-full">
        <thead>
        <tr>
            <th>Name</th>
            <th>Points</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($season->getStandings() as $standing)
            <tr>
                <td>{{ $standing->driver->full_name }}</td>
                <td>{{ $standing->points }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <br>

    @foreach ($season->races()->with('circuit')->get() as $race)
        <p>
            <a href="{{ route('rounds.show', [$season, $race]) }}">#{{$race->round}} &mdash;
                {{ $race->name }} &mdash; {{ $race->circuit->name }}</a>
        </p>
    @endforeach
@endsection

@push('scripts')
    <script>
        function seasonSelect() {
            return {
                season: @json($season->year),

                watch() {
                    this.$watch('season', () => {
                        window.location = '/seasons/' + this.season
                    })
                }
            }
        }
    </script>
@endpush
