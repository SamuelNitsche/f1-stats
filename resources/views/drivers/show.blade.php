@extends('layouts.app')

@section('title', $driver->name)

@section('content')
  <p>{{ $driver->full_name }}</p>

  <ul>
    @foreach($driver->seasons as $season)
      <li>{{ $season->year }}</li>
    @endforeach
  </ul>

  <p>Qualifying results</p>
  <table style="text-align: left;">
    <thead>
    <tr>
      <th>Season</th>
      <th>Track</th>
      <th>Position</th>
      <th>Q1</th>
      <th>Q2</th>
      <th>Q3</th>
    </tr>
    </thead>
    <tbody>
    @foreach($driver->qualifications()->with('season', 'track')->get() as $qualification)
      <tr>
        <td>
          {{ $qualification->season->year }}
        </td>
        <td>
          {{ $qualification->track->name }}
        </td>
        <td>
          {{ $qualification->pivot->position }}
        </td>
        <td>
          {{ $qualification->pivot->q1_time ?? 'N/A' }}
        </td>
        <td>
          {{ $qualification->pivot->q2_time ?? 'N/A' }}
        </td>
        <td>
          {{ $qualification->pivot->q3_time ?? 'N/A' }}
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>
@endsection