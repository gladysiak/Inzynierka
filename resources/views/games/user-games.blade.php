@extends('layout')

@section('styles')
    <link rel="stylesheet" href="/css/games-style.css">
@endsection

@section('content')
    @if(session()->has('message'))
        <div class="message">{{ session('message') }}</div>
    @endif
    <div class="container">
        @if(!$user->games->isEmpty())
            @foreach($user->games as $game)
                <div class="card">
                    <div class="box">
                        <div class="content">
                            <h1>{{ $game->game_name }}</h1>
                            <a href="/games/{{ $game->id }}">Szczegóły</a>
                        </div>
                        <form action="/games/{{ $game->id }}" method="post">
                            @csrf
                            @method("DELETE")
                            <button><i class="fa-sharp fa-solid fa-trash"></i></button>
                        </form>
                    </div>
                </div>
            @endforeach
        @else
            <div>
                <h1>Nie dodałeś jeszcze gier do swojej kolekcji</h1>
            </div>

        @endif
        <div class="search">
            <p style="font-size:40px">Twoje gry</p>
            <form class="search-form" action="/games">
                <div>
                    <input type="text" name="search" placeholder="Szukaj gier"/>
                </div>
            </form>
            <a href="/games"><button class="purple-button">Lista gier</button></a>
        </div>
    </div>
@endsection
