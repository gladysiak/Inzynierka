@extends('layout')

@section('styles')
    <link rel="stylesheet" href="/css/games-style.css">
@endsection

@section('content')
@if(session()->has('message'))
    <div class="message">{{ session('message') }}</div>
@endif
<div class="container">
    @if(!$games->isEmpty())
        @foreach($games as $game)
            <div class="card">
                <div class="box">
                    <div class="content">
                        <h1>{{ $game->game_name }}</h1>
                        <a href="/games/{{ $game->id }}">Szczegóły</a>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div>
            <h1>Niestety, taka gra nie istnieje w naszej bazie :(</h1>
            <a class="request-button" href="/games/add">Wyślij nam zgłoszenie nowej gry!</a>
        </div>

    @endif
        <div class="search">
            <p style="font-size:40px">Lista gier</p>
            <form class="search-form" action="/games">
                <div>
                    <input type="text" name="search" placeholder="Szukaj gier"/>
                </div>
            </form>
            <a href="/games/user-games"><button class="purple-button">Moje gry</button></a>
        </div>
</div>
@endsection
