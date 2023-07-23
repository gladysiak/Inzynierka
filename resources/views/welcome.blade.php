@extends('layout')

@section('styles')
    <link rel="stylesheet" href="/css/home-style.css">
@endsection

@section('content')
    @if(session()->has('message'))
        <div class="message">{{ session('message') }}</div>
    @endif
    <h1 style="color: white; text-align: center">Witaj na stronie głównej naszej biblioteki gier planszowych</h1>
@endsection
