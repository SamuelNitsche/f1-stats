@extends('layouts.app')

@section('title', 'Compare Drivers')

@section('content')
    <h1>Compare Drivers</h1>

{{--    Generate a side by side list of the number of attended races--}}
    <div class="flex w-full ">
        <div class="w-1/2">
            <h2 class="text-center">{{ $driver1->fullName }}</h2>
            <p>
                <span>Races:</span>
                <span>{{ $driver1->races->count() }}</span>
            </p>
            <p>
                <span>Career wins:</span>
                <span>{{ $driver1->results->where('position', 1)->count() }}</span>
            </p>
            <p>
                <span>Pole Positions:</span>
                <span>{{ $driver1->qualifications->where('position', 1)->count() }}</span>
            </p>
        </div>
        <div class="w-1/2">
            <h2 class="text-center">{{ $driver2->fullName }}</h2>
            <p>
                <span>Races:</span>
                <span>{{ $driver2->races->count() }}</span>
            </p>
            <p>
                <span>Career wins:</span>
                <span>{{ $driver2->results->where('position', 1)->count() }}</span>
            </p>
            <p>
                <span>Pole Positions:</span>
                <span>{{ $driver2->qualifications->where('position', 1)->count() }}</span>
            </p>
        </div>
    </div>
@endsection
