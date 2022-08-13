@extends('layouts.app')

@section('title', $circuit->name)

@section('content')
  <p>{{ $circuit->name }}</p>

  <details>
    <summary>Seasons</summary>
    @foreach($circuit->races as $race)
      <details>
        <summary>{{ $race->season->year }}</summary>

        @if ($race->qualifications)
          <details>
            <summary>Qualifying</summary>

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
              @foreach($race->qualifications as $qualification)
                <tr>
                  <td>{{ $qualification->position }}</td>
                  <td>{{ $qualification->driver->full_name }}</td>
                  <td>{{ $qualification->q1 ?? 'N/A' }}</td>
                  <td>{{ $qualification->q2 ?? 'N/A' }}</td>
                  <td>{{ $qualification->q3 ?? 'N/A' }}</td>
                </tr>
              @endforeach
              </tbody>
            </table>
          </details>
        @endif

        @if ($race->results)
          <details>
            <summary>Race</summary>

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
              @foreach($race->results as $result)
                <tr>
                  <td>{{ $result->position }}</td>
                  <td>{{ $result->driver->full_name }}</td>
                  <td>{{ $result->grid }}</td>
                  <td>{{ $result->time }}</td>
                  <td>{{ $result->status->status }}</td>
                  <td>{{ $result->laps }}</td>
                  <td>{{ $result->points }}</td>
                </tr>
              @endforeach
              </tbody>
            </table>
          </details>
        @endif
      </details>
    @endforeach
  </details>
@endsection
