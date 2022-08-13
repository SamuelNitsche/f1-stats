@extends('layouts.app')

@section('title', 'Tracks')

@section('content')
    <div class="grid grid-cols-3 grid-rows-3 gap-3">
        @foreach($circuits as $circuit)
            @include('circuits._card', $circuit)
        @endforeach
    </div>
@endsection
