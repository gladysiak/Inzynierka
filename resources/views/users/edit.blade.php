@extends('layout')

@section('styles')
    <link rel="stylesheet" href="/css/edit-acc-style.css">
@endsection

@section('content')
@if(session()->has('message'))
    <div class="message">{{ session('message') }}</div>
@endif
<div class="box">
    <div class="form">
        <h1>Moje Konto</h1>
        <div class="profile">
            <h2>E-mail</h2>
            <p>{{ $user->email }}</p>
            <h2>Nickname</h2>
            <p>{{ $user->name }}</p>
            <h2>Hasło</h2>
            <p>********** <a href="/users/{{ $user->id }}/edit/change-password"><button class="btn">Zmień</button></a></p>
        </div>
       {{-- <a href="/users/{{ $user->id }}/update-games">Edytuj listę swoich gier</a>--}}
    </div>
</div>
@endsection
