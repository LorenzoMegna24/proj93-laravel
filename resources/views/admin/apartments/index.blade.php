@extends('layouts.app')

@section('content')
    <h1>ciao</h1>
    @foreach ($apartments as $elem)
        <h2>{{$elem->title}}</h2>
    @endforeach
@endsection