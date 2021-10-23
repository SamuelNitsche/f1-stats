<p>{{ $driver->full_name }}</p>

<ul>
  @foreach($driver->seasons as $season)
    <li>{{ $season->year }}</li>
  @endforeach
</ul>

<ul>
    @foreach($driver->qualifications as $qualification)
        <li>
          {{ $qualification->season->year }}
          &mdash;
          {{ $qualification->track->name }}
          &mdash;
          {{ $qualification->pivot->position }}
          &mdash;
          {{ $qualification->pivot->q1_time }}
          &mdash;
          {{ $qualification->pivot->q2_time ?? 'N/A' }}
          &mdash;
          {{ $qualification->pivot->q3_time ?? 'N/A' }}
        </li>
    @endforeach
</ul>