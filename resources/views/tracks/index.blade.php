@foreach ($tracks as $track)
  <p>
    <a href="{{ route('tracks.show', $track) }}">{{ $track->name }}</a>
  </p>
@endforeach