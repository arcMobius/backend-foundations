@extends('layouts.main')

@section('content')
    <h1>Наши контакты</h1>
    <ul>
        @foreach($contactData as $key => $value)
            <li><strong>{{ ucfirst($key) }}:</strong> {{ $value }}</li>
        @endforeach
    </ul>
@endsection