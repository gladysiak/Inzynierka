@extends('layout')

@section('styles')
    <link rel="stylesheet" href="/css/register-style.css">
@endsection

@section('content')
<div class="box rejestracji">
    <form method="post" action="/register">
        @csrf
        <h1>Zarejestruj się</h1>
        <div class="inputBox">
            <input type="text" name="name" required="required">
            <span>Login</span>
            <i></i>
        </div>
        @if ($errors->has('name'))
            <p class="error-message">{{ $errors->first('name') }}</p>
        @endif
        <div class="inputBox">
            <input type="email" name="email" required="required">
            <span>Email</span>
            <i></i>
        </div>
        @if ($errors->has('email'))
            <p class="error-message">{{ $errors->first('email') }}</p>
        @endif
        <div class="inputBox">
            <input type="password" name="password" required="required">
            <span>Hasło</span>
            <i></i>
        </div>
        @if ($errors->has('password'))
            <p class="error-message">{{ $errors->first('password') }}</p>
        @endif
        <div class="inputBox">
            <input type="password" name="password_confirmation" required="required">
            <span>Powtórz hasło</span>
            <i></i>
        </div>
        @if ($errors->has('password_confirmation'))
            <p class="error-message">{{ $errors->first('password_confirmation') }}</p>
        @endif
        <input type="submit" value="Zarejestruj">
    </form>
</div>
@endsection
