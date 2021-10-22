@foreach ($seasons as $season)
  <p>
    <a href="{{ route('seasons.show', $season) }}">{{ $season->year }}</a>
  </p>
@endforeach