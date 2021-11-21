@extends('layouts.app')

@section('title', 'Drivers')

@section('content')
  @foreach ($drivers as $driver)
    <p>
      <a href="{{ route('drivers.show', $driver->slug) }}">{{ $driver->fullName }}</a>
    </p>
  @endforeach
@endsection