@extends('layouts.app')

@section('title', 'Seasons')

@section('content')
  @foreach ($seasons as $season)
    <p>
      <a href="{{ route('seasons.show', $season) }}">{{ $season->year }}</a>
    </p>
  @endforeach
@endsection