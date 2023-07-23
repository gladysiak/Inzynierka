@extends('layout')

@section('styles')
    <link rel="stylesheet" href="/css/register-style.css">
@endsection

@section('content')
    <div class="box logowania">
        <form method="post" action="/login">
            @csrf
            <h1>Zaloguj się</h1>
            <div class="inputBox">
                <input type="email" name="email" required="required">
                <span>Email</span>
                <i></i>
            </div>
            @if ($errors->has('email'))
                <p class="error-message">{{ $errors->first('email') }}</p>
            @endif
            <div class="inputBox">
                <input type="password" required="required" name="password">
                <span>Hasło</span>
                <i></i>
            </div>
            @if ($errors->has('password'))
                <p class="error-message">{{ $errors->first('password') }}</p>
            @endif
            <div class="links">
{{--                <a href="#">Zapomniałem hasła</a>--}}
                <a href="/register">Załóż konto</a>
            </div>
            <input type="submit" value="Zaloguj">
        </form>
    </div>

    {{--<h1>Zaloguj się</h1>

    <form method="post" action="/login">
        @csrf
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" name="email">
        </div>
        <div class="mb-3">
            <label class="form-label">Hasło</label>
            <input type="password" class="form-control" name="password">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>--}}
@endsection
