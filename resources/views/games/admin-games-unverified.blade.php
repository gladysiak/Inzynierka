@extends('layout')

@section('styles')
    <link rel="stylesheet" href="/css/table-style.css">
@endsection

@section('content')
    @if(session()->has('message'))
        <div class="message">{{ session('message') }}</div>
    @endif
    <div class="table">
        <div class="table_header">
            <p style="font-size:40px">Gry do weryfikacji</p>
            <div>
                <form style="display: inline" action="/admin-games-unverified">
                    <input type="text" name="search" placeholder="Szukaj gry" />
                </form>
                <a href="/admin-games"><button class="add_new">Wróć do panelu</button></a>
            </div>
        </div>

        <div class="table_section">
            <table>
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Nazwa gry</th>
                    <th>Zdjęcie</th>
                    <th>Akcje</th>
                </tr>
                </thead>
                <tbody>
                @foreach($games as $game)
                    <tr>
                        <td>{{ $game->id }}</td>
                        <td>{{ $game->game_name }}</td>
                        <td><img src="{{ asset('images/'.$game->game_image) }}" alt="Zdjęcie gry"></td>
                        <td>
                            <form style="display: inline" method="post" action="/admin-games-unverified/{{$game->id}}">
                                @csrf
                                @method('PUT')
                                <button class="green-background">Zatwierdź</button>
                            </form>
                            <form style="display: inline" method="post" action="/games/{{ $game->id }}">
                                @csrf
                                @method('DELETE')
                                <button class="trash-background"><i class="fa-sharp fa-solid fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {{ $games->links() }}
    </div>
@endsection
