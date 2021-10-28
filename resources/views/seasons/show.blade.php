<a href="{{ route('seasons.index') }}">Back to all seasons</a>

<p>{{ $season->year }}</p>

<p>Current championship leader: {{ $season->getChampionshipLeader()->full_name }}</p>

@foreach ($season->rounds()->with('track')->get() as $round)
  <p>
    <a href="{{ route('rounds.show', [$season, $round->round]) }}">#{{$round->round}} &mdash; {{ $round->name }} &mdash; {{ $round->track->name }}</a>
  </p>
@endforeach