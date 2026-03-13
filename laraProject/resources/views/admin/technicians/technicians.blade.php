@extends('layouts.public')

@section('content')
    <h1>Tecnici</h1>

    @foreach($technicians as $technician)
        <p>{{ $technician->username }} - {{ $technician->email }}</p>
    @endforeach
@endsection