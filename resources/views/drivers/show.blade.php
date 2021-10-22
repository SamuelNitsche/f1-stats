<p>{{ $driver->full_name }}</p>

<ul>
  @foreach($driver->seasons as $season)
    <li>{{ $season->year }}</li>
  @endforeach
</ul>