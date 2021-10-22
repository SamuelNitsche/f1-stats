@foreach ($drivers as $driver)
  <p>
    <a href="{{ route('drivers.show', $driver->slug) }}">{{ $driver->fullName }}</a>
  </p>
@endforeach