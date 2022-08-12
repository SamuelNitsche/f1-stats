@extends('layouts.app')

@section('title', 'Tracks')

@section('content')
    @foreach($circuits as $circuit)
        @include('circuits._link', $circuit)
    @endforeach
@endsection
