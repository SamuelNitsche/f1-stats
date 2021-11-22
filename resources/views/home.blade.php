@extends('layouts.app')

@section('title', 'Home')

@section('content')
  <p>Next Race</p>
  <p>
    <a
        href="{{ route('rounds.show', [$upcomingRound->season, $upcomingRound]) }}"
    >{{ $upcomingRound->name }} - in <time datetime="{{ $upcomingRound->date }}">{{ $upcomingRound->date->longAbsoluteDiffForHumans() }}</time></a>
  </p>
@endsection
