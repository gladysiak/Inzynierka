@extends('layout')

@section('content')
    <main class="container">
        <form action="/users/{{ $user->id }}/update-games" method="POST">
            @csrf
            @method('PUT')

            <label for="games">Wybierz gry, które posiadasz:</label>
            <select class="select-multiple" name="games[]" id="games" multiple>
                @foreach($games as $game)
                    <option value="{{ $game->id }}" {{ $user->games->contains($game) ? 'selected' : '' }}>
                        {{ $game->game_name }}
                    </option>
                @endforeach
            </select>

            <button class="btn btn-primary" type="submit">Zapisz</button>
        </form>
    </main>
@endsection
