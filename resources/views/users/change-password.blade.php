@extends('layout')

@section('styles')
    <link rel="stylesheet" href="/css/change-pwd-style.css">
@endsection

@section('content')
    @if(session()->has('message'))
        <div class="message">{{ session('message') }}</div>
    @endif
    <div class="box">
        <form action="/users/{{ $user->id }}/edit-password" method="POST">
            @csrf
            @method('PUT')
            <h1>Zmień hasło</h1>
            <div class="inputBox">
                <input type="password" name="current_password" required="required">
                <span>Aktualne hasło</span>
                <i></i>
            </div>
            @error('current_password')
            <p class="error-message">{{ $message }}</p>
            @enderror
            <div class="inputBox">
                <input type="password" name="new_password" required="required">
                <span>Nowe Hasło</span>
                <i></i>
            </div>
            @error('new_password')
            <p class="error-message">{{ $message }}</p>
            @enderror
            <div class="inputBox">
                <input type="password" name="new_password_confirmation" required="required">
                <span>Powtórz Nowe hasło</span>
                <i></i>
            </div>
            <input type="submit" value="Zmień Hasło">
        </form>
    </div>
@endsection
