@extends('layouts.app')

@section('title', 'Drivers')

@section('content')
    @foreach(range('A', 'Z') as $letter)
        <a href="{{ route('drivers.index', ['letter' => $letter]) }}" class="text-blue-500">{{ $letter }}</a>
    @endforeach

    @foreach ($drivers as $driver)
        <p>
            <a href="{{ route('drivers.show', $driver->driverRef) }}">{{ $driver->fullName }}</a>
        </p>
    @endforeach
@endsection
