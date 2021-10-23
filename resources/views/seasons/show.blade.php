<a href="{{ route('seasons.index') }}">Back to all seasons</a>

<p>{{ $season->year }}</p>

@foreach ($season->rounds as $round)
  <p>
    <a href="{{ route('rounds.show', [$season, $round->round]) }}">#{{$round->round}} &mdash; {{ $round->name }} &mdash; {{ $round->track->name }}</a>
  </p>
@endforeach