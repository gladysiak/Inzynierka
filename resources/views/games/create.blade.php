@extends('layout')

@section('styles')
    <link rel="stylesheet" href="/css/create-by-admin-style.css">
@endsection

@section('content')

<div class="box">
    <form method="post" action="/games/create" enctype="multipart/form-data">
        @csrf
        <h1>Utwórz grę</h1>

        <div class="inputBox">
            <input type="text" name="game_name" required="required">
            <span>Nazwa gry</span>
            <i></i>
        </div>
        @if ($errors->has('game_name'))
            <p class="error-message">{{ $errors->first('game_name') }}</p>
        @endif

        <div class="inputBox">
            <input type="text" name="game_players_num" required="required">
            <span>Liczba graczy</span>
            <i></i>
        </div>
        @if ($errors->has('game_players_num'))
            <p class="error-message">{{ $errors->first('game_players_num') }}</p>
        @endif

        <div class="inputBox">
            <input type="text" name="game_players_age" required="required">
            <span>Wiek graczy</span>
            <i></i>
        </div>
        @if ($errors->has('game_players_age'))
            <p class="error-message">{{ $errors->first('game_players_age') }}</p>
        @endif

        <div class="inputBox">
            <input type="text" name="game_producer" required="required">
            <span>Producent</span>
            <i></i>
        </div>
        @if ($errors->has('game_producer'))
            <p class="error-message">{{ $errors->first('game_producer') }}</p>
        @endif

        <div class="inputBox">
            <input type="file" name="game_image" required="required">
            <i></i>
        </div>
        @if ($errors->has('game_image'))
            <p class="error-message">{{ $errors->first('game_image') }}</p>
        @endif

        <div class="inputBox">
            <textarea id="myTextarea" name="game_desc" placeholder="Opis gry"></textarea>
        </div>
        @if ($errors->has('game_desc'))
            <p class="error-message">{{ $errors->first('game_desc') }}</p>
        @endif

        <input style="margin-top: 30px" type="submit" value="Utwórz grę">
    </form>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Funkcja do dynamicznego dostosowywania wysokości textarea
        function adjustTextareaHeight() {
            const textarea = document.getElementById("myTextarea");
            textarea.style.height = "0"; // Zerujemy wysokość, aby później ją dostosować
            const newHeight = textarea.scrollHeight;
            textarea.style.height = newHeight + "px"; // Ustawiamy dostosowaną wysokość
        }

        // Dodajemy obsługę zdarzenia input
        document.getElementById("myTextarea").addEventListener("input", function() {
            adjustTextareaHeight();
        });

        // Wywołujemy funkcję dostosowującą wysokość przy załadowaniu strony
        adjustTextareaHeight();
    });
</script>

@endsection
