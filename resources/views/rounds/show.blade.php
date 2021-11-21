@extends('layouts.app')

@section('title', 'Rounds')

@section('content')
  <a href="{{ route('seasons.show', $round->season) }}">Back to season</a>

  <p>{{ $round->name }}</p>
  <p>{{ $round->track->name  }}</p>

  <details>
    <summary>Qualifying</summary>
    @if ($round->qualification)
      <table style="text-align: left">
        <thead>
        <tr>
          <th>Position</th>
          <th>Driver Name</th>
          <th>Q1 Time</th>
          <th>Q2 Time</th>
          <th>Q3 Time</th>
        </tr>
        </thead>
        <tbody>
        @foreach($round->qualification->drivers as $driver)
          <tr>
            <td>{{ $driver->pivot->position }}</td>
            <td>{{ $driver->full_name }}</td>
            <td>{{ $driver->pivot->q1_time }}</td>
            <td>{{ $driver->pivot->q2_time ?? 'N/A' }}</td>
            <td>{{ $driver->pivot->q3_time ?? 'N/A' }}</td>
          </tr>
        @endforeach
        </tbody>
      </table>
    @endif
  </details>

  <details>
    <summary>Race</summary>
    @if ($round->race)
      <table style="text-align: left;">
        <thead>
        <tr>
          <th>Position</th>
          <th>Driver Name</th>
          <th>Grid</th>
          <th>Total Time</th>
          <th>Status</th>
          <th>Laps</th>
          <th>Points</th>
        </tr>
        </thead>
        <tbody>
        @foreach($round->race->drivers as $driver)
          <tr>
            <td>{{ $driver->pivot->position }} <small>{{ $driver->pivot->getPositionsGainedOrLost() }}</small></td>
            <td>{{ $driver->full_name }}</td>
            <td>{{ $driver->pivot->grid }}</td>
            <td>{{ $driver->pivot->total_time }}</td>
            <td>{{ $driver->pivot->status }}</td>
            <td>{{ $driver->pivot->laps }}</td>
            <td>{{ $driver->pivot->points }}</td>
          </tr>
        @endforeach
        </tbody>
      </table>
    @endif
  </details>
@endsection