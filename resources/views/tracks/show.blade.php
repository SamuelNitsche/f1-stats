<p>{{ $track->name }}</p>

<p>Fastest qualifying track overall: {{ \App\Models\DriverQualification::forTrack($track)->min('q1_time') }}</p>

<ul>
  @foreach($track->qualifications as $qualification)
    <li>
      {{ $qualification->season->year }}
      &mdash;
      {{ $qualification->track->name }}
{{--      &mdash;--}}
{{--      {{ $qualification->pivot->position }}--}}
{{--      &mdash;--}}
{{--      {{ $qualification->pivot->q1_time }}--}}
{{--      &mdash;--}}
{{--      {{ $qualification->pivot->q2_time ?? 'N/A' }}--}}
{{--      &mdash;--}}
{{--      {{ $qualification->pivot->q3_time ?? 'N/A' }}--}}
{{--    </li>--}}
  @endforeach
</ul>